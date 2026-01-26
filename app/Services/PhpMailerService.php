<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerService
{
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
        $mailer->Host = (string) config('mail.mailers.smtp.host');
        $mailer->Port = (int) config('mail.mailers.smtp.port', 587);

        // Auth
        $mailer->SMTPAuth = true;
        $mailer->Username = (string) config('mail.mailers.smtp.username');
        $mailer->Password = (string) config('mail.mailers.smtp.password');

        // Encryption handling: tls/ssl/none
        $enc = config('mail.mailers.smtp.encryption');
        if (is_string($enc)) {
            $enc = strtolower(trim($enc));
        }

        if ($enc === 'tls') {
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        } elseif ($enc === 'ssl') {
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            // no encryption
            $mailer->SMTPSecure = false;
            $mailer->SMTPAutoTLS = false;
        }

        // General transport safety
        $mailer->Timeout = 30;
        $mailer->SMTPKeepAlive = false;

        // From / Reply-To
        $fromAddress = (string) config('mail.from.address');
        $fromName = (string) config('mail.from.name', config('app.name', 'Precise Diagnostics Imaging'));

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
     *
     * $attachments:
     *  - string path: "C:/.../file.pdf"
     *  - descriptor array:
     *      [
     *        'path' => '/abs/path/file.pdf', 'name' => 'Report.pdf', 'type' => 'application/pdf'
     *      ]
     *  - descriptor with 'content' => binary string:
     *      [
     *        'content' => $binary, 'name' => 'file.pdf', 'type' => 'application/pdf'
     *      ]
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
            ]);

            throw new \RuntimeException('Email could not be sent: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * This is the exact method used by ReportService in the new system.
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
     * Updated to NEW schema:
     *   $report->imagingService->visit->patient
     *
     * This method expects the report has an attachment stored on disk (path).
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

        // array
        foreach ($to as $key => $value) {
            // Associative ["email" => "Name"]
            if (is_string($key) && filter_var($key, FILTER_VALIDATE_EMAIL)) {
                $mailer->addAddress($key, (string) $value);
                continue;
            }

            // Numeric list ["email1", "email2"]
            if (is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $mailer->addAddress($value);
                continue;
            }

            // If someone passes [0 => ["email" => "...", "name" => "..."]] we ignore for safety
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
            // simple string file path
            if (is_string($attachment)) {
                if (is_file($attachment)) {
                    $mailer->addAttachment($attachment);
                }
                continue;
            }

            // descriptor array
            if (is_array($attachment)) {
                // String attachment (binary content)
                if (isset($attachment['content'])) {
                    $content = (string) $attachment['content'];
                    $name = (string) ($attachment['name'] ?? 'attachment.pdf');
                    $type = (string) ($attachment['type'] ?? 'application/pdf');

                    $mailer->addStringAttachment($content, $name, 'base64', $type);
                    continue;
                }

                // File attachment
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
