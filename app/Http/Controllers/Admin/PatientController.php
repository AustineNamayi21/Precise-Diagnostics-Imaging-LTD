<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePatientRequest;
use App\Http\Requests\Admin\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query()->latest();

        if ($request->filled('q')) {
            $q = '%' . $request->string('q') . '%';
            $query->where(function ($w) use ($q) {
                $w->where('first_name', 'like', $q)
                    ->orWhere('last_name', 'like', $q)
                    ->orWhere('phone', 'like', $q)
                    ->orWhere('email', 'like', $q)
                    ->orWhere('patient_number', 'like', $q);
            });
        }

        $patients = $query->paginate(20)->withQueryString();

        return view('admin.patients.index', compact('patients'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        if ($q === '') {
            return response()->json([]);
        }

        $like = '%' . $q . '%';

        $patients = Patient::query()
            ->where('first_name', 'like', $like)
            ->orWhere('last_name', 'like', $like)
            ->orWhere('phone', 'like', $like)
            ->orWhere('email', 'like', $like)
            ->orWhere('patient_number', 'like', $like)
            ->orderByDesc('id')
            ->limit(15)
            ->get(['id', 'patient_number', 'first_name', 'last_name', 'phone', 'email']);

        return response()->json($patients);
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        $patient = Patient::create($data);

        return redirect()
            ->route('admin.patients.show', $patient)
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load(['visits' => fn($q) => $q->latest()]);
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return redirect()
            ->route('admin.patients.show', $patient)
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()
            ->route('admin.patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
