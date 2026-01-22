<?php

namespace App\Http\Controllers;

use App\Models\RadiologyReport;
use Illuminate\Http\Request;
use App\Services\PhpMailerService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ReportDeliveryController extends Controller
{
    protected $mailService;

    public function __construct(PhpMailerService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function sendReport(Request $request, RadiologyReport $report)
    {
        // Check if report is finalized
        if ($report->status !== 'finalized') {
            return back()->with('error', 'Only finalized reports can be sent to patients.');
        }

        // Check if already sent
        if ($report->sent_to_patient) {
            return back()->with('warning', 'This report has already been sent to the patient.');
        }

        // Get patient email
        $patient = $report->serviceRecord->visit->patient;
        $patientEmail = $patient->email;

        if (!$patientEmail) {
            return back()->with('error', 'Patient email not found.');
        }

        try {
            // Generate PDF
            $pdf = Pdf::loadView('radiology-reports.pdf', compact('report'));
            $pdfContent = $pdf->output(); // Get PDF as content
            
            // Save PDF temporarily for debugging
            $pdfPath = storage_path('app/temp/report-' . $report->id . '-' . time() . '.pdf');
            if (!file_exists(dirname($pdfPath))) {
                mkdir(dirname($pdfPath), 0755, true);
            }
            $pdf->save($pdfPath);

            // Send email using PHPMailer
            $this->mailService->sendRadiologyReport($report, $pdfContent);

            // Update report status
            $report->update([
                'sent_to_patient' => true,
                'sent_at' => now(),
            ]);

            // Clean up temporary file
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }

            // Log successful delivery
            Log::info('Radiology report sent to patient', [
                'report_id' => $report->id,
                'report_number' => $report->report_number,
                'patient_id' => $patient->id,
                'patient_email' => $patientEmail,
            ]);

            return back()->with('success', 'Report sent successfully to ' . $patientEmail);
            
        } catch (\Exception $e) {
            // Clean up temporary file on error
            if (isset($pdfPath) && file_exists($pdfPath)) {
                unlink($pdfPath);
            }
            
            // Log error
            Log::error('Failed to send radiology report', [
                'report_id' => $report->id,
                'patient_id' => $patient->id ?? null,
                'error' => $e->getMessage(),
            ]);
            
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function sendBulkReports(Request $request)
    {
        $reportIds = $request->input('report_ids', []);
        
        if (empty($reportIds)) {
            return back()->with('error', 'No reports selected.');
        }

        $reports = RadiologyReport::whereIn('id', $reportIds)
            ->where('status', 'finalized')
            ->where('sent_to_patient', false)
            ->with(['serviceRecord.visit.patient'])
            ->get();

        $successCount = 0;
        $errorCount = 0;
        $errors = [];

        foreach ($reports as $report) {
            try {
                // Generate PDF
                $pdf = Pdf::loadView('radiology-reports.pdf', compact('report'));
                $pdfContent = $pdf->output();
                
                // Send email
                $this->mailService->sendRadiologyReport($report, $pdfContent);
                
                // Update report status
                $report->update([
                    'sent_to_patient' => true,
                    'sent_at' => now(),
                ]);
                
                $successCount++;
                
            } catch (\Exception $e) {
                $errorCount++;
                $errors[] = 'Report ' . $report->report_number . ': ' . $e->getMessage();
                Log::error('Failed to send report ' . $report->report_number . ': ' . $e->getMessage());
            }
        }

        $message = "Successfully sent {$successCount} reports.";
        
        if ($errorCount > 0) {
            $message .= " Failed to send {$errorCount} reports.";
            session()->flash('bulk_errors', $errors);
        }

        return back()->with('success', $message);
    }

    public function testEmail(Request $request)
    {
        try {
            $testEmail = auth()->user()->email;
            
            $this->mailService->sendEmail(
                $testEmail,
                'Test Email - Precise Diagnostics',
                '<h1>Test Email</h1><p>This is a test email from Precise Diagnostics Imaging system.</p><p>If you received this email, your PHPMailer configuration is working correctly.</p>'
            );
            
            return back()->with('success', 'Test email sent to ' . $testEmail);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    public function deliveryHistory(Request $request)
    {
        $reports = RadiologyReport::where('sent_to_patient', true)
            ->with(['serviceRecord.visit.patient', 'radiologist'])
            ->latest('sent_at')
            ->paginate(20);

        return view('report-delivery.history', compact('reports'));
    }
}