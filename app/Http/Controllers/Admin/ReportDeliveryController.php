<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendRadiologyReportRequest;
use App\Models\RadiologyReport;
use App\Models\ReportDelivery;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportDeliveryController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function index(Request $request)
    {
        $query = ReportDelivery::query()
            ->with(['report.imagingService.visit.patient', 'report.imagingService.service', 'sender'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('sent_at', $request->string('date'));
        }

        $deliveries = $query->paginate(20)->withQueryString();

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function send(SendRadiologyReportRequest $request, RadiologyReport $radiologyReport)
    {
        $this->reportService->sendFinalReportToPatient(
            report: $radiologyReport,
            overrideEmail: $request->validated()['email'] ?? null,
            customMessage: $request->validated()['message'] ?? null,
            sentBy: auth()->id()
        );

        return redirect()
            ->route('admin.reports.show', $radiologyReport)
            ->with('success', 'Report sent successfully.');
    }
}
