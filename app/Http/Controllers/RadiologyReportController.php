<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRadiologyReportRequest;
use App\Http\Requests\Admin\UpdateRadiologyReportRequest;
use App\Models\ImagingService;
use App\Models\RadiologyReport;
use App\Services\ReportService;
use Illuminate\Http\Request;

class RadiologyReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function index(Request $request)
    {
        $query = RadiologyReport::query()
            ->with(['imagingService.service', 'imagingService.visit.patient'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $reports = $query->paginate(20)->withQueryString();
        return view('admin.reports.index', compact('reports'));
    }

    public function createForImagingService(ImagingService $imagingService)
    {
        $imagingService->load(['visit.patient', 'service', 'report']);

        if ($imagingService->report) {
            return redirect()
                ->route('admin.reports.edit', $imagingService->report)
                ->with('info', 'A report already exists for this imaging service.');
        }

        return view('admin.reports.create-for-imaging-service', compact('imagingService'));
    }

    public function storeForImagingService(StoreRadiologyReportRequest $request, ImagingService $imagingService)
    {
        $report = $this->reportService->createReportForImagingService(
            imagingService: $imagingService,
            reportText: $request->validated()['report_text'] ?? null,
            attachment: $request->file('attachment'),
            createdBy: auth()->id()
        );

        return redirect()
            ->route('admin.reports.edit', $report)
            ->with('success', 'Report created successfully.');
    }

    public function show(RadiologyReport $report)
    {
        $report->load(['imagingService.service', 'imagingService.visit.patient', 'deliveries.sender']);
        return view('admin.reports.show', compact('report'));
    }

    public function edit(RadiologyReport $report)
    {
        $report->load(['imagingService.service', 'imagingService.visit.patient', 'deliveries.sender']);
        return view('admin.reports.edit', compact('report'));
    }

    public function update(UpdateRadiologyReportRequest $request, RadiologyReport $report)
    {
        $this->reportService->updateReport(
            report: $report,
            reportText: $request->validated()['report_text'] ?? null,
            attachment: $request->file('attachment'),
            removeAttachment: (bool)($request->validated()['remove_attachment'] ?? false)
        );

        return redirect()
            ->route('admin.reports.edit', $report)
            ->with('success', 'Report updated successfully.');
    }

    public function destroy(RadiologyReport $report)
    {
        $this->reportService->deleteReport($report);

        return redirect()
            ->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    public function finalize(RadiologyReport $radiologyReport)
    {
        $this->reportService->finalizeReport($radiologyReport, auth()->id());

        return redirect()
            ->route('admin.reports.show', $radiologyReport)
            ->with('success', 'Report finalized successfully.');
    }

    public function preview(RadiologyReport $radiologyReport)
    {
        $radiologyReport->load(['imagingService.service', 'imagingService.visit.patient']);
        return view('admin.reports.preview', ['report' => $radiologyReport]);
    }

    public function download(RadiologyReport $radiologyReport)
    {
        return $this->reportService->downloadAttachment($radiologyReport);
    }
}
