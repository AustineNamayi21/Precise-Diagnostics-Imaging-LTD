@extends('layouts.admin')

@section('title','Patient')
@section('page_title','Patient Record')
@section('page_subtitle','Patient profile and visit history')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-5" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">Patient</div>
                <span class="badge badge-soft">#{{ $patient->id }}</span>
            </div>
            <div class="card-body">
                <div class="mb-2 text-muted small">Name</div>
                <div class="fw-bold h5">{{ $patient->first_name }} {{ $patient->last_name }}</div>

                <div class="row g-3 mt-1">
                    <div class="col-6">
                        <div class="text-muted small">Phone</div>
                        <div class="fw-semibold">{{ $patient->phone }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Email</div>
                        <div class="fw-semibold">{{ $patient->email ?? '—' }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">DOB</div>
                        <div class="fw-semibold">
                            {{ $patient->dob ? \Illuminate\Support\Carbon::parse($patient->dob)->toDateString() : '—' }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Gender</div>
                        <div class="fw-semibold">{{ $patient->gender ? ucfirst($patient->gender) : '—' }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Address</div>
                        <div class="fw-semibold">{{ $patient->address ?? '—' }}</div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 flex-wrap">
                    {{-- New Visit --}}
                    <a class="btn btn-pd" href="{{ route('admin.visits.create', ['patient_id' => $patient->id]) }}">
                        <i class="fa-solid fa-plus me-1"></i>New Visit
                    </a>

                    {{-- Edit patient --}}
                    <a class="btn btn-outline-secondary" href="{{ route('admin.patients.edit', ['patient' => $patient->id]) }}">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>

                    {{-- Back --}}
                    <a class="btn btn-outline-secondary" href="{{ route('admin.patients.index') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-7" data-aos="fade-up" data-aos-delay="50">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Visits</div>
                    <div class="text-muted small">All visits linked to this patient</div>
                </div>

                {{-- ✅ FIX: Use existing visits index with filter instead of missing route --}}
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.visits.index', ['patient_id' => $patient->id]) }}">
                    View all
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Services</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(($patient->visits ?? collect())->take(10) as $v)
                            <tr>
                                <td class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($v->visit_date)->toDateString() }}</td>
                                <td>
                                    <span class="badge badge-soft">
                                        {{ ucfirst($v->status ?? 'scheduled') }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $v->imagingServices?->count() ?? 0 }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.visits.show', ['visit' => $v->id]) }}">
                                        <i class="fa-solid fa-eye me-1"></i>Open
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No visits yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-muted small">Tip: Create a visit, then attach imaging services to it.</div>
            </div>
        </div>
    </div>
</div>
@endsection
