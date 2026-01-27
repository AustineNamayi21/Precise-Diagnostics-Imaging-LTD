<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with('patient')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.visits.index', compact('visits'));
    }

    public function byPatient(Patient $patient)
    {
        $visits = $patient->visits()
            ->latest()
            ->paginate(20)
            ->withQueryString();

        // reuse the same visits index view but with patient context
        return view('admin.visits.index', [
            'visits' => $visits,
            'patient' => $patient,
        ]);
    }

    public function create()
    {
        // ✅ The view expects $patients
        $patients = Patient::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->limit(500)
            ->get();

        return view('admin.visits.create', compact('patients'));
    }

    public function store(StoreVisitRequest $request)
    {
        $visit = Visit::create($request->validated());

        return redirect()
            ->route('admin.visits.show', $visit)
            ->with('success', 'Visit created successfully.');
    }

    public function show(Visit $visit)
    {
        $visit->load(['patient', 'imagingServices.service', 'imagingServices.report']);

        return view('admin.visits.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $patients = Patient::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->limit(500)
            ->get();

        return view('admin.visits.edit', compact('visit', 'patients'));
    }

    public function update(UpdateVisitRequest $request, Visit $visit)
    {
        $visit->update($request->validated());

        return redirect()
            ->route('admin.visits.show', $visit)
            ->with('success', 'Visit updated successfully.');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Visit deleted successfully.');
    }
}
