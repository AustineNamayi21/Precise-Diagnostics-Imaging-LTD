@extends('layouts.admin')

@section('title','Visit')
@section('page_title','Visit Details')
@section('page_subtitle','Attach imaging services and manage workflow')

@section('content')
@php
    $patient = $visit->patient;
    $services = $services ?? []; // catalog of services
@endphp

<div class="row g-3">
    <!-- Visit info -->
    <div class="col-12 col-lg-5" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">Visit #{{ $visit->id }}</div>
                <span class="badge badge-soft">{{ ucfirst($visit->status ?? 'scheduled') }}</span>
            </div>
            <div class="card-body">
                <div class="mb-2 text-muted small">Patient</div>
                <div class="fw-bold h5 mb-1">{{ $patient?->first_name }} {{ $patient?->last_name }}</div>
                <div class="text-muted small">{{ $patient?->phone }} @if($patient?->email) • {{ $patient->email }} @endif</div>

                <hr>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-muted small">Visit Date</div>
                        <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($visit->visit_date)->toDateString() }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Services Count</div>
                        <div class="fw-semibold">{{ $visit->imagingServices?->count() ?? 0 }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted small">Notes</div>
                        <div class="fw-semibold">{{ $visit->notes ?? '—' }}</div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.visits.edit', $visit) }}">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit Visit
                    </a>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.patients.show', $patient) }}">
                        <i class="fa-solid fa-user me-1"></i>Patient
                    </a>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.visits.index') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Add imaging service -->
        <div class="card pd-card mt-3" data-aos="fade-up" data-aos-delay="60">
            <div class="card-header">
                <div class="fw-bold"><i class="fa-solid fa-plus me-2"></i>Add Imaging Service</div>
                <div class="text-muted small">Step 2: Attach service to this visit</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.visits.imaging-services.store', $visit) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Service</label>
                        <select class="form-select" name="service_id" required>
                            <option value="">Select service...</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} • KES {{ number_format($s->price ?? 0) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select" name="status">
                            @foreach(['ordered','performed','reported','cancelled'] as $st)
                                <option value="{{ $st }}" @selected(old('status','ordered')===$st)>{{ ucfirst($st) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-pd w-100">
                        <i class="fa-solid fa-link me-2"></i>Attach Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Imaging services list -->
    <div class="col-12 col-lg-7" data-aos="fade-up" data-aos-delay="40">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Imaging Services for this Visit</div>
                <div class="text-muted small">Create a report for each service</div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Report</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($visit->imagingServices ?? [] as $img)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $img->service?->name ?? '—' }}</div>
                                    <div class="text-muted small">KES {{ number_format($img->service?->price ?? 0) }}</div>
                                </td>
                                <td><span class="badge badge-soft">{{ ucfirst($img->status ?? 'ordered') }}</span></td>
                                <td>
                                    @if($img->report)
                                        <span class="badge text-bg-success">Yes</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.imaging-services.show', $img) }}">
                                        <i class="fa-solid fa-eye me-1"></i>Open
                                    </a>
                                    @if(!$img->report)
                                        <a class="btn btn-sm btn-outline-success"
                                           href="{{ route('admin.reports.create.for-imaging-service', $img) }}">
                                            <i class="fa-solid fa-file-circle-plus me-1"></i>Create Report
                                        </a>
                                    @else
                                        <a class="btn btn-sm btn-outline-secondary"
                                           href="{{ route('admin.reports.show', $img->report) }}">
                                            <i class="fa-solid fa-file-medical me-1"></i>View Report
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No imaging services attached yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-muted small">
                    Tip: Order/perform service → Create report → Finalize → Send to patient.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
