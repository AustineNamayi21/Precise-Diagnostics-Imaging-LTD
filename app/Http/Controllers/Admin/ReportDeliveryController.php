<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendRadiologyReportRequest;
use App\Models\RadiologyReport;
use App\Models\ReportDelivery;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportDeliveryController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function index(Request $request): View
    {
        // ✅ IMPORTANT: your ReportDelivery model has relation "report()"
        // There is NO "radiologyReport()" relation.
        $query = ReportDelivery::query()
            ->with([
                'report.imagingService.visit.patient',
                'report.imagingService.service',
                'sender',
            ])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('date')) {
            $query->whereDate('sent_at', $request->string('date')->toString());
        }

        $deliveries = $query->paginate(20)->withQueryString();

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function show(ReportDelivery $report_delivery): View
    {
        $report_delivery->load([
            'report.imagingService.visit.patient',
            'report.imagingService.service',
            'sender',
        ]);

        return view('admin.deliveries.show', [
            'delivery' => $report_delivery,
        ]);
    }

    public function send(SendRadiologyReportRequest $request, RadiologyReport $radiologyReport): RedirectResponse
    {
        $validated = $request->validated();

        // Prevent sending drafts
        if (($radiologyReport->status ?? null) !== 'final') {
            return redirect()
                ->route('admin.radiology-reports.show', ['radiology_report' => $radiologyReport->id])
                ->with('error', 'You can only send a finalized report.');
        }

        // If email is empty, try to fall back to patient email
        $overrideEmail = $validated['email'] ?? null;

        if (! $overrideEmail) {
            $radiologyReport->loadMissing(['imagingService.visit.patient']);

            $overrideEmail = $radiologyReport->imagingService?->visit?->patient?->email;

            if (! $overrideEmail) {
                return redirect()
                    ->route('admin.radiology-reports.show', ['radiology_report' => $radiologyReport->id])
                    ->with('error', 'No recipient email found. Please enter an email address for the patient.');
            }
        }

        $this->reportService->sendFinalReportToPatient(
            report: $radiologyReport,
            overrideEmail: $overrideEmail,
            customMessage: $validated['message'] ?? null,
            sentBy: auth()->id()
        );

        return redirect()
            ->route('admin.radiology-reports.show', ['radiology_report' => $radiologyReport->id])
            ->with('success', 'Report sent successfully.');
    }
}
