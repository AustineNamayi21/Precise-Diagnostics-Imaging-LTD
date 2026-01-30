<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVisitRequest;
use App\Http\Requests\Admin\UpdateVisitRequest;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitController extends Controller
{
    /**
     * Display a listing of visits.
     */
    public function index(Request $request): View
    {
        $query = Visit::query()->with(['patient'])->latest();

        // ✅ Allow filtering by patient (used by patient show page "View all")
        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        $visits = $query->paginate(15)->withQueryString();

        return view('admin.visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new visit.
     */
    public function create(Request $request): View
    {
        // ✅ Patients are in patients table (not users)
        $patients = Patient::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        // ✅ Preselect if coming from /admin/patients/{id} -> New Visit
        $selectedPatientId = $request->get('patient_id');

        return view('admin.visits.create', compact('patients', 'selectedPatientId'));
    }

    /**
     * Store a newly created visit in storage.
     */
    public function store(StoreVisitRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Map notes -> clinical_notes if your DB uses clinical_notes
        if (array_key_exists('notes', $data)) {
            $data['clinical_notes'] = $data['notes'];
            unset($data['notes']);
        }

        // Track creator (if column exists)
        $data['created_by'] = auth()->id();

        $visit = Visit::create($data);

        // ✅ If visit was created while viewing a patient, go back to that patient
        if (!empty($visit->patient_id)) {
            return redirect()
                ->route('admin.patients.show', ['patient' => $visit->patient_id])
                ->with('success', 'Visit created successfully.');
        }

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Visit created successfully.');
    }

    /**
     * Display the specified visit.
     */
    public function show(Visit $visit): View
    {
        $visit->load(['patient', 'imagingServices.service']);

        // Only fetch active services
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('modality')
            ->orderBy('name')
            ->get();

        return view('admin.visits.show', compact('visit', 'services'));
    }

    /**
     * Show the form for editing the specified visit.
     */
    public function edit(Visit $visit): View
    {
        $patients = Patient::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view('admin.visits.edit', compact('visit', 'patients'));
    }

    /**
     * Update the specified visit in storage.
     */
    public function update(UpdateVisitRequest $request, Visit $visit): RedirectResponse
    {
        $data = $request->validated();

        // Map notes -> clinical_notes
        if (array_key_exists('notes', $data)) {
            $data['clinical_notes'] = $data['notes'];
            unset($data['notes']);
        }

        $visit->update($data);

        return redirect()
            ->route('admin.visits.show', ['visit' => $visit->id])
            ->with('success', 'Visit updated successfully.');
    }

    /**
     * Remove the specified visit from storage.
     */
    public function destroy(Visit $visit): RedirectResponse
    {
        $visit->delete();

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Visit deleted successfully.');
    }
}
