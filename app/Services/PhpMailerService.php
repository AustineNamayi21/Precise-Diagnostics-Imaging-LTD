<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class PhpMailerService
{
    protected $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        
        try {
            // Server settings - use Laravel config values
            $this->mailer->SMTPDebug = config('app.debug') ? 2 : 0;
            $this->mailer->isSMTP();
            $this->mailer->Host = config('mail.mailers.smtp.host');
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = config('mail.mailers.smtp.username');
            $this->mailer->Password = config('mail.mailers.smtp.password');
            $this->mailer->SMTPSecure = config('mail.mailers.smtp.encryption');
            $this->mailer->Port = config('mail.mailers.smtp.port');
            
            // Recipients
            $this->mailer->setFrom(
                config('mail.from.address'),
                config('mail.from.name')
            );
            
            if (config('mail.from.address')) {
                $this->mailer->addReplyTo(
                    config('mail.from.address'),
                    config('mail.from.name')
                );
            }
            
            // Content settings
            $this->mailer->isHTML(true);
            $this->mailer->CharSet = 'UTF-8';
            
        } catch (Exception $e) {
            Log::error('PHPMailer initialization failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function sendEmail($to, $subject, $body, $attachments = [], $cc = [], $bcc = [])
    {
        try {
            // Clear previous recipients
            $this->mailer->clearAddresses();
            $this->mailer->clearCCs();
            $this->mailer->clearBCCs();
            $this->mailer->clearAttachments();
            $this->mailer->clearReplyTos();
            
            // Set from address again
            $this->mailer->setFrom(
                config('mail.from.address'),
                config('mail.from.name')
            );
            
            if (config('mail.from.address')) {
                $this->mailer->addReplyTo(
                    config('mail.from.address'),
                    config('mail.from.name')
                );
            }
            
            // Add recipients
            if (is_string($to)) {
                $this->mailer->addAddress($to);
            } elseif (is_array($to)) {
                foreach ($to as $email => $name) {
                    if (is_numeric($email)) {
                        $this->mailer->addAddress($name);
                    } else {
                        $this->mailer->addAddress($email, $name);
                    }
                }
            }
            
            // Add CC recipients
            foreach ($cc as $email => $name) {
                if (is_numeric($email)) {
                    $this->mailer->addCC($name);
                } else {
                    $this->mailer->addCC($email, $name);
                }
            }
            
            // Add BCC recipients
            foreach ($bcc as $email => $name) {
                if (is_numeric($email)) {
                    $this->mailer->addBCC($name);
                } else {
                    $this->mailer->addBCC($email, $name);
                }
            }
            
            // Add attachments - UPDATED FOR PDF CONTENT
            foreach ($attachments as $attachment) {
                if (is_array($attachment)) {
                    // Handle PDF content as string
                    if (isset($attachment['content'])) {
                        // Add string attachment (for PDF content)
                        $this->mailer->addStringAttachment(
                            $attachment['content'],
                            $attachment['name'] ?? 'attachment.pdf',
                            'base64',
                            $attachment['type'] ?? 'application/pdf'
                        );
                    } elseif (isset($attachment['path']) && file_exists($attachment['path'])) {
                        // Add file attachment
                        $this->mailer->addAttachment(
                            $attachment['path'],
                            $attachment['name'] ?? 'attachment',
                            $attachment['encoding'] ?? 'base64',
                            $attachment['type'] ?? '',
                            $attachment['disposition'] ?? 'attachment'
                        );
                    }
                } elseif (is_string($attachment) && file_exists($attachment)) {
                    // Simple file path
                    $this->mailer->addAttachment($attachment);
                }
            }
            
            // Content
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->AltBody = strip_tags($body);
            
            // Send email
            $this->mailer->send();
            
            Log::info('Email sent successfully to: ' . json_encode($to));
            return true;
            
        } catch (Exception $e) {
            Log::error('Email could not be sent. Error: ' . $this->mailer->ErrorInfo);
            throw new \Exception('Email could not be sent. Error: ' . $this->mailer->ErrorInfo);
        }
    }

    public function sendRadiologyReport($report, $pdfContent)
    {
        $patient = $report->serviceRecord->visit->patient;
        
        $subject = 'Your Radiology Report - ' . config('app.name', 'Precise Diagnostics');
        
        // Render email body from view
        $body = view('emails.radiology-report', [
            'report' => $report,
            'patient' => $patient,
        ])->render();
        
        // Prepare attachments array with PDF content
        $attachments = [
            [
                'content' => $pdfContent, // PDF content as string
                'name' => 'radiology-report-' . $report->report_number . '.pdf',
                'type' => 'application/pdf',
            ]
        ];
        
        return $this->sendEmail(
            $patient->email,
            $subject,
            $body,
            $attachments
        );
    }
    
    /**
     * Simple test method to verify email configuration
     */
    public function testEmail($toEmail, $toName = null)
    {
        try {
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
            
            // Send without attachments
            return $this->sendEmail(
                $toEmail,
                $subject,
                $body
            );
            
        } catch (\Exception $e) {
            throw new \Exception('Test email failed: ' . $e->getMessage());
        }
    }
}