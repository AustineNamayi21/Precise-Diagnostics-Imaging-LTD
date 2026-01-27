<?php

namespace App\Services;

use App\Models\ImagingService;
use App\Models\RadiologyReport;
use App\Models\ReportDelivery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportService
{
    public function __construct(private readonly PhpMailerService $mailer)
    {
    }

    public function createReportForImagingService(
        ImagingService $imagingService,
        ?string $reportText,
        ?UploadedFile $attachment,
        ?int $createdBy
    ): RadiologyReport {
        if ($imagingService->report) {
            throw new \RuntimeException('A report already exists for this imaging service.');
        }

        $payload = [
            'imaging_service_id' => $imagingService->id,
            'report_text' => $reportText,
            'status' => 'draft',
            'created_by' => $createdBy,
        ];

        if ($attachment) {
            // ✅ Store on PUBLIC disk for consistent access + downloads + storage:link
            $path = $attachment->store('radiology_reports', 'public');

            $payload['attachment_path'] = $path;
            $payload['attachment_name'] = $attachment->getClientOriginalName();
            $payload['attachment_mime'] = $attachment->getClientMimeType();
            $payload['attachment_size'] = $attachment->getSize();
        }

        return RadiologyReport::create($payload);
    }

    public function updateReport(
        RadiologyReport $report,
        ?string $reportText,
        ?UploadedFile $attachment,
        bool $removeAttachment
    ): void {
        if ($report->status === 'final') {
            throw new \RuntimeException('Finalized reports cannot be edited.');
        }

        $update = [];

        if (!is_null($reportText)) {
            $update['report_text'] = $reportText;
        }

        if ($removeAttachment) {
            $this->deleteAttachmentIfExists($report);
            $update['attachment_path'] = null;
            $update['attachment_name'] = null;
            $update['attachment_mime'] = null;
            $update['attachment_size'] = null;
        }

        if ($attachment) {
            $this->deleteAttachmentIfExists($report);

            // ✅ Store on public disk
            $path = $attachment->store('radiology_reports', 'public');

            $update['attachment_path'] = $path;
            $update['attachment_name'] = $attachment->getClientOriginalName();
            $update['attachment_mime'] = $attachment->getClientMimeType();
            $update['attachment_size'] = $attachment->getSize();
        }

        if (!empty($update)) {
            $report->update($update);
        }
    }

    public function finalizeReport(RadiologyReport $report, int $finalizedBy): void
    {
        if ($report->status === 'final') {
            return;
        }

        // ✅ Must validate attachment exists on public disk
        if (!$report->attachment_path || !Storage::disk('public')->exists($report->attachment_path)) {
            throw new \RuntimeException('Cannot finalize a report without an uploaded attachment.');
        }

        $report->update([
            'status' => 'final',
            'finalized_by' => $finalizedBy,
            'finalized_at' => now(),
        ]);

        // Update imaging service status
        $report->imagingService()->update(['status' => 'reported']);
    }

    public function sendFinalReportToPatient(
        RadiologyReport $report,
        ?string $overrideEmail,
        ?string $customMessage,
        int $sentBy
    ): void {
        $report->load(['imagingService.service', 'imagingService.visit.patient']);

        if ($report->status !== 'final') {
            throw new \RuntimeException('Only FINAL reports can be sent.');
        }

        if (!$report->attachment_path || !Storage::disk('public')->exists($report->attachment_path)) {
            throw new \RuntimeException('No attachment found to send.');
        }

        $patient = $report->imagingService->visit->patient;
        $toEmail = $overrideEmail ?: $patient->email;

        if (!$toEmail) {
            throw new \RuntimeException('Patient email is missing.');
        }

        $serviceName = $report->imagingService->service->name ?? 'Imaging Service';
        $patientName = trim(($patient->first_name ?? '') . ' ' . ($patient->last_name ?? ''));

        $subject = 'Your Radiology Report - Precise Diagnostics Imaging';
        $body = $customMessage ?: $this->defaultEmailBody($patientName, $serviceName);

        // ✅ Build absolute file path for PHPMailer from public disk
        $absolutePath = Storage::disk('public')->path($report->attachment_path);
        $attachmentName = $report->attachment_name ?: basename($report->attachment_path);

        $sentAt = now();

        try {
            $this->mailer->sendWithAttachment(
                to: $toEmail,
                subject: $subject,
                htmlBody: $body,
                attachmentPath: $absolutePath,
                attachmentName: $attachmentName
            );

            ReportDelivery::create([
                'radiology_report_id' => $report->id,
                'sent_to_email' => $toEmail,
                'sent_by' => $sentBy,
                'sent_at' => $sentAt,
                'status' => 'sent',
                'error_message' => null,
            ]);

            $report->imagingService()->update(['status' => 'delivered']);
        } catch (\Throwable $e) {
            ReportDelivery::create([
                'radiology_report_id' => $report->id,
                'sent_to_email' => $toEmail,
                'sent_by' => $sentBy,
                'sent_at' => $sentAt,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function downloadAttachment(RadiologyReport $report): StreamedResponse
    {
        if (!$report->attachment_path || !Storage::disk('public')->exists($report->attachment_path)) {
            abort(404, 'No attachment found for this report.');
        }

        $name = $report->attachment_name ?: basename($report->attachment_path);

        return Storage::disk('public')->download($report->attachment_path, $name);
    }

    public function deleteReport(RadiologyReport $report): void
    {
        $this->deleteAttachmentIfExists($report);
        $report->delete();
    }

    private function deleteAttachmentIfExists(RadiologyReport $report): void
    {
        if ($report->attachment_path && Storage::disk('public')->exists($report->attachment_path)) {
            Storage::disk('public')->delete($report->attachment_path);
        }
    }

    private function defaultEmailBody(string $patientName, string $serviceName): string
    {
        return "
            <p>Dear {$patientName},</p>
            <p>Please find attached your finalized radiology report for <strong>{$serviceName}</strong>.</p>
            <p>Thank you for choosing Precise Diagnostics Imaging.</p>
            <p><em>This is an automated message. Please contact the facility if you have questions.</em></p>
        ";
    }
}
