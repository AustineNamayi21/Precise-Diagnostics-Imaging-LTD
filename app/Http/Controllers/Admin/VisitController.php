<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVisitRequest;
use App\Http\Requests\Admin\UpdateVisitRequest;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::query()
            ->with(['patient'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('visit_date', $request->string('date'));
        }

        if ($request->filled('q')) {
            $q = '%' . $request->string('q') . '%';
            $query->whereHas('patient', function ($p) use ($q) {
                $p->where('first_name', 'like', $q)
                    ->orWhere('last_name', 'like', $q)
                    ->orWhere('phone', 'like', $q)
                    ->orWhere('patient_number', 'like', $q);
            });
        }

        $visits = $query->paginate(20)->withQueryString();

        return view('admin.visits.index', compact('visits'));
    }

    public function byPatient(Patient $patient)
    {
        $visits = $patient->visits()->latest()->paginate(20)->withQueryString();
        return view('admin.visits.by-patient', compact('patient', 'visits'));
    }

    public function create(Request $request)
    {
        // Allow preselect patient ?patient_id=...
        $patient = null;
        if ($request->filled('patient_id')) {
            $patient = Patient::find($request->integer('patient_id'));
        }

        return view('admin.visits.create', compact('patient'));
    }

    public function store(StoreVisitRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        $visit = Visit::create($data);

        return redirect()
            ->route('admin.visits.show', $visit)
            ->with('success', 'Visit created successfully.');
    }

    public function show(Visit $visit)
    {
        $visit->load([
            'patient',
            'imagingServices.service',
            'imagingServices.report',
        ]);

        return view('admin.visits.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $visit->load('patient');
        return view('admin.visits.edit', compact('visit'));
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
