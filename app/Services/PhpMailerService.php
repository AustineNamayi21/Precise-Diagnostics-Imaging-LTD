<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerService
{
    /**
     * Resolve SMTP settings in a forgiving way across Laravel versions/config styles.
     */
    protected function smtp(string $key, mixed $default = null): mixed
    {
        // Prefer mailer config (Laravel 10/11/12 style)
        $mailerKey = "mail.mailers.smtp.{$key}";
        $value = config($mailerKey);

        if ($value !== null && $value !== '') {
            return $value;
        }

        // Fallback to old/simple mail keys (some projects use these)
        $legacyMap = [
            'host' => 'mail.host',
            'port' => 'mail.port',
            'username' => 'mail.username',
            'password' => 'mail.password',
            'encryption' => 'mail.encryption',
        ];

        if (isset($legacyMap[$key])) {
            $legacyValue = config($legacyMap[$key]);
            if ($legacyValue !== null && $legacyValue !== '') {
                return $legacyValue;
            }
        }

        // Final fallback to env directly (last resort)
        $envMap = [
            'host' => ['MAIL_MAILERS_SMTP_HOST', 'MAIL_HOST'],
            'port' => ['MAIL_MAILERS_SMTP_PORT', 'MAIL_PORT'],
            'username' => ['MAIL_MAILERS_SMTP_USERNAME', 'MAIL_USERNAME'],
            'password' => ['MAIL_MAILERS_SMTP_PASSWORD', 'MAIL_PASSWORD'],
            'encryption' => ['MAIL_MAILERS_SMTP_ENCRYPTION', 'MAIL_ENCRYPTION'],
        ];

        if (isset($envMap[$key])) {
            foreach ($envMap[$key] as $envKey) {
                $envValue = env($envKey);
                if ($envValue !== null && $envValue !== '') {
                    return $envValue;
                }
            }
        }

        return $default;
    }

    /**
     * Create and configure a new PHPMailer instance.
     * We create a NEW instance per send to avoid state leakage.
     */
    protected function makeMailer(): PHPMailer
    {
        $mailer = new PHPMailer(true);

        // Debug level: never expose full SMTP traffic in production
        $debug = (bool) config('app.debug', false);
        $mailer->SMTPDebug = $debug ? 2 : 0; // 2 shows client/server messages
        $mailer->Debugoutput = static function ($str, $level) {
            Log::debug("[PHPMailer][$level] " . $str);
        };

        $mailer->isSMTP();

        // Host/Port
        $mailer->Host = (string) $this->smtp('host', 'smtp.gmail.com');
        $mailer->Port = (int) $this->smtp('port', 587);

        // Auth
        $mailer->SMTPAuth = true;
        $mailer->Username = (string) $this->smtp('username', '');
        $mailer->Password = (string) $this->smtp('password', '');

        if ($mailer->Username === '' || $mailer->Password === '') {
            throw new \RuntimeException(
                'SMTP username/password not set. Check MAIL_* / MAIL_MAILERS_SMTP_* in .env and config/mail.php'
            );
        }

        // Encryption handling: tls/ssl/none
        $enc = $this->smtp('encryption', null);
        if (is_string($enc)) {
            $enc = strtolower(trim($enc));
        }

        // If port is 587 and enc missing, assume tls (common Gmail setup)
        if (($enc === null || $enc === '') && (int) $mailer->Port === 587) {
            $enc = 'tls';
        }

        // If port is 465 and enc missing, assume ssl
        if (($enc === null || $enc === '') && (int) $mailer->Port === 465) {
            $enc = 'ssl';
        }

        if ($enc === 'tls') {
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->SMTPAutoTLS = true;
        } elseif ($enc === 'ssl') {
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mailer->SMTPAutoTLS = true;
        } else {
            // no encryption
            $mailer->SMTPSecure = false;
            $mailer->SMTPAutoTLS = false;
        }

        // General transport safety
        $mailer->Timeout = 30;
        $mailer->SMTPKeepAlive = false;

        // From / Reply-To (also forgiving)
        $fromAddress =
            (string) (config('mail.from.address') ?: env('MAIL_FROM_ADDRESS', ''));

        $fromName =
            (string) (config('mail.from.name')
                ?: env('MAIL_FROM_NAME', config('app.name', 'Precise Diagnostics Imaging')));

        if ($fromAddress === '') {
            throw new \RuntimeException('MAIL_FROM_ADDRESS is not set. Check your .env and config/mail.php');
        }

        $mailer->setFrom($fromAddress, $fromName);
        $mailer->addReplyTo($fromAddress, $fromName);

        // Content defaults
        $mailer->isHTML(true);
        $mailer->CharSet = 'UTF-8';

        return $mailer;
    }

    /**
     * Send a general email.
     *
     * $to can be:
     *  - string email: "someone@gmail.com"
     *  - array list: ["a@gmail.com", "b@gmail.com"]
     *  - associative: ["a@gmail.com" => "Name A", "b@gmail.com" => "Name B"]
     */
    public function sendEmail(
        string|array $to,
        string $subject,
        string $body,
        array $attachments = [],
        array $cc = [],
        array $bcc = []
    ): bool {
        $mailer = $this->makeMailer();

        try {
            // Recipients
            $this->addRecipients($mailer, $to);
            $this->addCc($mailer, $cc);
            $this->addBcc($mailer, $bcc);

            // Attachments
            $this->addAttachments($mailer, $attachments);

            // Content
            $mailer->Subject = $subject;
            $mailer->Body = $body;
            $mailer->AltBody = trim(strip_tags($body));

            $mailer->send();

            Log::info('PHPMailer: Email sent', [
                'to' => $to,
                'subject' => $subject,
            ]);

            return true;
        } catch (Exception $e) {
            Log::error('PHPMailer: sendEmail failed', [
                'error' => $e->getMessage(),
                'to' => $to,
                'subject' => $subject,
                'host' => $mailer->Host ?? null,
                'port' => $mailer->Port ?? null,
                'encryption' => $this->smtp('encryption', null),
            ]);

            throw new \RuntimeException('Email could not be sent: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * It sends ONE attachment from disk (absolute path).
     */
    public function sendWithAttachment(
        string $to,
        string $subject,
        string $htmlBody,
        string $attachmentPath,
        string $attachmentName = 'attachment.pdf'
    ): void {
        if (!is_file($attachmentPath)) {
            throw new \RuntimeException("Attachment file not found: {$attachmentPath}");
        }

        $this->sendEmail(
            to: $to,
            subject: $subject,
            body: $htmlBody,
            attachments: [[
                'path' => $attachmentPath,
                'name' => $attachmentName,
            ]]
        );
    }

    /**
     * Optional helper: send a RadiologyReport to the patient.
     */
    public function sendRadiologyReport(\App\Models\RadiologyReport $report, ?string $overrideEmail = null): bool
    {
        $report->loadMissing(['imagingService.visit.patient', 'imagingService.service']);

        $patient = $report->imagingService->visit->patient;
        $serviceName = $report->imagingService->service->name ?? 'Imaging Service';

        $toEmail = $overrideEmail ?: $patient->email;
        if (!$toEmail) {
            throw new \RuntimeException('Patient email is missing.');
        }

        $subject = 'Your Radiology Report - ' . config('app.name', 'Precise Diagnostics Imaging');

        $body = view('emails.radiology-report', [
            'report' => $report,
            'patient' => $patient,
            'serviceName' => $serviceName,
        ])->render();

        if (!$report->attachment_path) {
            throw new \RuntimeException('Report has no attachment_path to send.');
        }

        $absolutePath = storage_path('app/' . $report->attachment_path);
        $attachmentName = $report->attachment_name ?: ('radiology-report-' . $report->id . '.pdf');

        $this->sendWithAttachment(
            to: $toEmail,
            subject: $subject,
            htmlBody: $body,
            attachmentPath: $absolutePath,
            attachmentName: $attachmentName
        );

        return true;
    }

    /**
     * Simple test method to verify email configuration.
     */
    public function testEmail(string $toEmail, ?string $toName = null): bool
    {
        $subject = 'Test Email - Precise Diagnostics Imaging';
        $body = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .header { background-color: #4a90e2; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Test Email Successful!</h1>
            </div>
            <div class="content">
                <p>This is a test email from Precise Diagnostics Imaging system.</p>
                <p>If you received this email, your PHPMailer configuration is working correctly.</p>
                <p><strong>Timestamp:</strong> ' . now()->format('Y-m-d H:i:s') . '</p>
            </div>
        </body>
        </html>
        ';

        if ($toName) {
            return $this->sendEmail([$toEmail => $toName], $subject, $body);
        }

        return $this->sendEmail($toEmail, $subject, $body);
    }

    // -----------------------
    // Internal helpers
    // -----------------------

    protected function addRecipients(PHPMailer $mailer, string|array $to): void
    {
        if (is_string($to)) {
            $mailer->addAddress($to);
            return;
        }

        foreach ($to as $key => $value) {
            if (is_string($key) && filter_var($key, FILTER_VALIDATE_EMAIL)) {
                $mailer->addAddress($key, (string) $value);
                continue;
            }

            if (is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $mailer->addAddress($value);
                continue;
            }
        }
    }

    protected function addCc(PHPMailer $mailer, array $cc): void
    {
        foreach ($cc as $key => $value) {
            if (is_string($key) && filter_var($key, FILTER_VALIDATE_EMAIL)) {
                $mailer->addCC($key, (string) $value);
            } elseif (is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $mailer->addCC($value);
            }
        }
    }

    protected function addBcc(PHPMailer $mailer, array $bcc): void
    {
        foreach ($bcc as $key => $value) {
            if (is_string($key) && filter_var($key, FILTER_VALIDATE_EMAIL)) {
                $mailer->addBCC($key, (string) $value);
            } elseif (is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $mailer->addBCC($value);
            }
        }
    }

    protected function addAttachments(PHPMailer $mailer, array $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (is_string($attachment)) {
                if (is_file($attachment)) {
                    $mailer->addAttachment($attachment);
                }
                continue;
            }

            if (is_array($attachment)) {
                if (isset($attachment['content'])) {
                    $content = (string) $attachment['content'];
                    $name = (string) ($attachment['name'] ?? 'attachment.pdf');
                    $type = (string) ($attachment['type'] ?? 'application/pdf');

                    $mailer->addStringAttachment($content, $name, 'base64', $type);
                    continue;
                }

                if (isset($attachment['path'])) {
                    $path = (string) $attachment['path'];
                    if (!is_file($path)) {
                        continue;
                    }

                    $name = (string) ($attachment['name'] ?? basename($path));
                    $encoding = (string) ($attachment['encoding'] ?? 'base64');
                    $type = (string) ($attachment['type'] ?? '');
                    $disposition = (string) ($attachment['disposition'] ?? 'attachment');

                    $mailer->addAttachment($path, $name, $encoding, $type, $disposition);
                    continue;
                }
            }
        }
    }
}
