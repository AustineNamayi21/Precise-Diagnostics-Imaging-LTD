<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\ImagingService;
use App\Models\ServiceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientVisitController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientVisit::with(['patient', 'radiographer']);

        if ($request->has('date')) {
            $query->whereDate('visit_date', $request->date);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $visits = $query->latest()->paginate(20);

        return view('patient-visits.index', compact('visits'));
    }

    public function create()
    {
        $patients = Patient::active()->get();
        return view('patient-visits.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'visit_type' => 'required|in:consultation,imaging,follow_up,emergency',
            'reason_for_visit' => 'required|string|max:500',
            'clinical_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $visit = PatientVisit::create([
            'patient_id' => $request->patient_id,
            'visit_date' => $request->visit_date,
            'visit_time' => $request->visit_time,
            'visit_type' => $request->visit_type,
            'reason_for_visit' => $request->reason_for_visit,
            'radiographer_id' => auth()->id(),
            'clinical_notes' => $request->clinical_notes,
            'status' => 'scheduled',
        ]);

        return redirect()->route('patient-visits.show', $visit)
            ->with('success', 'Visit created successfully.');
    }

    public function show(PatientVisit $patientVisit)
    {
        $patientVisit->load([
            'patient',
            'radiographer',
            'serviceRecords.service',
            'serviceRecords.radiologist',
            'serviceRecords.report'
        ]);

        $services = ImagingService::active()->get();

        return view('patient-visits.show', compact('patientVisit', 'services'));
    }

    public function edit(PatientVisit $patientVisit)
    {
        $patients = Patient::active()->get();
        return view('patient-visits.edit', compact('patientVisit', 'patients'));
    }

    public function update(Request $request, PatientVisit $patientVisit)
    {
        $validator = Validator::make($request->all(), [
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'visit_type' => 'required|in:consultation,imaging,follow_up,emergency',
            'reason_for_visit' => 'required|string|max:500',
            'clinical_notes' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'payment_status' => 'required|in:pending,paid,partial',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $patientVisit->update($request->all());

        return redirect()->route('patient-visits.show', $patientVisit)
            ->with('success', 'Visit updated successfully.');
    }

    public function destroy(PatientVisit $patientVisit)
    {
        $patientVisit->delete();

        return redirect()->route('patient-visits.index')
            ->with('success', 'Visit deleted successfully.');
    }

    public function addService(Request $request, PatientVisit $visit)
    {
        $validator = Validator::make($request->all(), [
            'imaging_service_id' => 'required|exists:imaging_services,id',
            'radiologist_id' => 'nullable|exists:users,id',
            'service_date' => 'required|date',
            'technician_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $visit->serviceRecords()->create([
            'imaging_service_id' => $request->imaging_service_id,
            'radiologist_id' => $request->radiologist_id,
            'service_date' => $request->service_date,
            'technician_notes' => $request->technician_notes,
            'status' => 'scheduled',
        ]);

        $visit->calculateTotalAmount();

        return redirect()->back()
            ->with('success', 'Service added successfully.');
    }

    public function removeService($recordId)
    {
        $record = ServiceRecord::findOrFail($recordId);
        $visit = $record->visit;
        
        $record->delete();
        
        $visit->calculateTotalAmount();

        return redirect()->back()
            ->with('success', 'Service removed successfully.');
    }

    public function updateServiceStatus(Request $request, $recordId)
    {
        $record = ServiceRecord::findOrFail($recordId);
        
        $record->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Service status updated.');
    }

    public function patientVisits(Patient $patient)
    {
        $visits = $patient->visits()->with(['serviceRecords.service'])->latest()->paginate(10);
        
        return view('patient-visits.patient-history', compact('patient', 'visits'));
    }
}