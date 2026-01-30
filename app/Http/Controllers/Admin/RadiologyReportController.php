<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImagingService;
use App\Models\RadiologyReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RadiologyReportController extends Controller
{
    /**
     * List reports
     */
    public function index(Request $request): View
    {
        $query = RadiologyReport::query()
            ->with(['imagingService.visit.patient', 'imagingService.service'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        $reports = $query->paginate(20)->withQueryString();

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show create form (expects imaging_service_id query param)
     * GET /admin/radiology-reports/create?imaging_service_id=2
     */
    public function create(Request $request): View
    {
        $imagingServiceId = (int) $request->query('imaging_service_id');

        if ($imagingServiceId <= 0) {
            abort(404, 'Missing imaging_service_id');
        }

        $imagingService = ImagingService::query()
            ->with(['visit.patient', 'service', 'report'])
            ->findOrFail($imagingServiceId);

        // prevent duplicates: if report already exists, go to it
        if ($imagingService->report) {
            return redirect()
                ->route('admin.radiology-reports.show', ['radiology_report' => $imagingService->report->id])
                ->with('info', 'A report already exists for this imaging service.');
        }

        return view('admin.reports.create', [
            'imagingService' => $imagingService,
        ]);
    }

    /**
     * Store a report
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'imaging_service_id' => ['required', 'integer', 'exists:imaging_services,id'],
            'report_text' => ['nullable', 'string', 'max:20000'],
            'status' => ['required', 'in:draft,final'],
            'attachment' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ], [
            'imaging_service_id.required' => 'Imaging service is required.',
            'imaging_service_id.exists' => 'Selected imaging service does not exist.',
            'attachment.required' => 'Please upload the report file.',
            'attachment.mimes' => 'Upload a PDF, DOC or DOCX file.',
        ]);

        $imagingService = ImagingService::query()
            ->with(['report'])
            ->findOrFail($validated['imaging_service_id']);

        // prevent duplicates
        if ($imagingService->report) {
            return redirect()
                ->route('admin.radiology-reports.show', ['radiology_report' => $imagingService->report->id])
                ->with('info', 'A report already exists for this imaging service.');
        }

        $attachmentPath = $request->file('attachment')->store('reports', 'public');

        $report = RadiologyReport::create([
            'imaging_service_id' => $imagingService->id,
            'report_text' => $validated['report_text'] ?? null,
            'status' => $validated['status'],
            'attachment_path' => $attachmentPath,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.radiology-reports.show', ['radiology_report' => $report->id])
            ->with('success', 'Report created successfully.');
    }

    /**
     * Show report
     */
    public function show(RadiologyReport $radiology_report): View
    {
        $radiology_report->load(['imagingService.visit.patient', 'imagingService.service']);

        return view('admin.reports.show', [
            'report' => $radiology_report,
        ]);
    }

    /**
     * Edit form
     */
    public function edit(RadiologyReport $radiology_report): View
    {
        $radiology_report->load(['imagingService.visit.patient', 'imagingService.service']);

        return view('admin.reports.edit', [
            'report' => $radiology_report,
        ]);
    }

    /**
     * Update report
     */
    public function update(Request $request, RadiologyReport $radiology_report): RedirectResponse
    {
        $validated = $request->validate([
            'report_text' => ['nullable', 'string', 'max:20000'],
            'status' => ['required', 'in:draft,final'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        if ($request->hasFile('attachment')) {
            $radiology_report->attachment_path = $request->file('attachment')->store('reports', 'public');
        }

        $radiology_report->fill([
            'report_text' => $validated['report_text'] ?? null,
            'status' => $validated['status'],
        ])->save();

        return redirect()
            ->route('admin.radiology-reports.show', ['radiology_report' => $radiology_report->id])
            ->with('success', 'Report updated successfully.');
    }

    /**
     * Delete report
     */
    public function destroy(RadiologyReport $radiology_report): RedirectResponse
    {
        $radiology_report->delete();

        return redirect()
            ->route('admin.radiology-reports.index')
            ->with('success', 'Report deleted successfully.');
    }
}
