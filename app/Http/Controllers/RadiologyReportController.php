<?php

namespace App\Http\Controllers;

use App\Models\RadiologyReport;
use App\Models\ServiceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class RadiologyReportController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyReport::with(['serviceRecord.visit.patient', 'radiologist']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('radiologist_id')) {
            $query->where('radiologist_id', $request->radiologist_id);
        }

        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $reports = $query->latest()->paginate(20);

        return view('radiology-reports.index', compact('reports'));
    }

    public function create(Request $request)
    {
        $serviceRecordId = $request->query('service_record_id');
        
        if ($serviceRecordId) {
            $serviceRecord = ServiceRecord::with(['visit.patient', 'service'])->findOrFail($serviceRecordId);
            $serviceRecords = collect([$serviceRecord]);
        } else {
            $serviceRecords = ServiceRecord::pendingReporting()->with(['visit.patient', 'service'])->get();
        }

        return view('radiology-reports.create', compact('serviceRecords'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_record_id' => 'required|exists:service_records,id',
            'clinical_history' => 'nullable|string',
            'technique' => 'nullable|string',
            'findings' => 'required|string',
            'impression' => 'required|string',
            'recommendations' => 'nullable|string',
            'priority' => 'required|in:routine,urgent,stat',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $report = RadiologyReport::create([
            'service_record_id' => $request->service_record_id,
            'radiologist_id' => auth()->id(),
            'clinical_history' => $request->clinical_history,
            'technique' => $request->technique,
            'findings' => $request->findings,
            'impression' => $request->impression,
            'recommendations' => $request->recommendations,
            'priority' => $request->priority,
            'status' => 'draft',
        ]);

        $serviceRecord = ServiceRecord::find($request->service_record_id);
        $serviceRecord->update(['status' => 'completed']);

        return redirect()->route('radiology-reports.edit', $report)
            ->with('success', 'Report created successfully. You can now finalize it.');
    }

    public function show(RadiologyReport $radiologyReport)
    {
        $radiologyReport->load([
            'serviceRecord.service',
            'serviceRecord.visit.patient',
            'radiologist'
        ]);

        return view('radiology-reports.show', compact('radiologyReport'));
    }

    public function edit(RadiologyReport $radiologyReport)
    {
        if (!$radiologyReport->isEditable()) {
            return redirect()->route('radiology-reports.show', $radiologyReport)
                ->with('error', 'This report cannot be edited as it is already finalized.');
        }

        $radiologyReport->load(['serviceRecord.service', 'serviceRecord.visit.patient']);

        return view('radiology-reports.edit', compact('radiologyReport'));
    }

    public function update(Request $request, RadiologyReport $radiologyReport)
    {
        if (!$radiologyReport->isEditable()) {
            return redirect()->back()
                ->with('error', 'This report cannot be edited as it is already finalized.');
        }

        $validator = Validator::make($request->all(), [
            'clinical_history' => 'nullable|string',
            'technique' => 'nullable|string',
            'findings' => 'required|string',
            'impression' => 'required|string',
            'recommendations' => 'nullable|string',
            'priority' => 'required|in:routine,urgent,stat',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $radiologyReport->update($request->all());

        return redirect()->route('radiology-reports.show', $radiologyReport)
            ->with('success', 'Report updated successfully.');
    }

    public function destroy(RadiologyReport $radiologyReport)
    {
        if (!$radiologyReport->isEditable()) {
            return redirect()->back()
                ->with('error', 'Only draft reports can be deleted.');
        }

        $radiologyReport->delete();

        return redirect()->route('radiology-reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    public function finalize(RadiologyReport $radiologyReport)
    {
        if ($radiologyReport->status !== 'draft') {
            return redirect()->back()
                ->with('error', 'Only draft reports can be finalized.');
        }

        $radiologyReport->finalize();

        return redirect()->route('radiology-reports.show', $radiologyReport)
            ->with('success', 'Report finalized successfully. It can now be sent to the patient.');
    }

    public function preview(RadiologyReport $radiologyReport)
    {
        $radiologyReport->load([
            'serviceRecord.service',
            'serviceRecord.visit.patient',
            'radiologist'
        ]);

        return view('radiology-reports.preview', compact('radiologyReport'));
    }

    public function downloadPDF(RadiologyReport $radiologyReport)
    {
        $radiologyReport->load([
            'serviceRecord.service',
            'serviceRecord.visit.patient',
            'radiologist'
        ]);

        $pdf = Pdf::loadView('radiology-reports.pdf', compact('radiologyReport'));

        return $pdf->download('report-' . $radiologyReport->report_number . '.pdf');
    }
}