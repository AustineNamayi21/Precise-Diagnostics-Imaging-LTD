@extends('layouts.admin')

@section('title','Imaging Service')
@section('page_title','Imaging Service')
@section('page_subtitle','Manage service status and workflow')

@section('content')
@php
    $visit = $imagingService->visit;
    $patient = $visit?->patient;
    $service = $imagingService->service;

    $statusOptions = ['ordered','performed','reported','cancelled'];
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-5" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">Imaging Service #{{ $imagingService->id }}</div>
                <span class="badge badge-soft">{{ ucfirst($imagingService->status ?? 'ordered') }}</span>
            </div>

            <div class="card-body">
                <div class="mb-2 text-muted small">Patient</div>
                <div class="fw-bold h5 mb-1">
                    {{ $patient?->first_name }} {{ $patient?->last_name }}
                </div>
                <div class="text-muted small">
                    {{ $patient?->phone }}
                    @if($patient?->email) • {{ $patient->email }} @endif
                </div>

                <hr>

                <div class="mb-2 text-muted small">Service</div>
                <div class="fw-semibold">{{ $service?->name ?? '—' }}</div>
                <div class="text-muted small">
                    Modality: {{ $service?->modality ?? '—' }} •
                    Price: KES {{ number_format($service?->price ?? 0) }}
                </div>

                <hr>

                <div class="text-muted small mb-2">Update Status</div>

                <form method="POST" action="{{ route('admin.imaging-services.update-status', ['imaging_service' => $imagingService->id]) }}">
                    @csrf
                    @method('PATCH')

                    <div class="input-group">
                        <select class="form-select" name="status" required>
                            @foreach($statusOptions as $st)
                                <option value="{{ $st }}" @selected(($imagingService->status ?? 'ordered') === $st)>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-pd" type="submit">
                            <i class="fa-solid fa-rotate me-1"></i>Update
                        </button>
                    </div>

                    @error('status')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </form>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    @if($visit)
                        <a class="btn btn-outline-secondary" href="{{ route('admin.visits.show', ['visit' => $visit->id]) }}">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back to Visit
                        </a>
                    @endif

                    <a class="btn btn-outline-secondary" href="{{ route('admin.imaging-services.index') }}">
                        <i class="fa-solid fa-list me-1"></i>All Imaging Services
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-7" data-aos="fade-up" data-aos-delay="40">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Report</div>
                <div class="text-muted small">Attached radiology report for this imaging service</div>
            </div>

            <div class="card-body">
                @if($imagingService->report)
                    <div class="alert alert-success d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">Report exists</div>
                            <div class="text-muted small">Report ID #{{ $imagingService->report->id }}</div>
                        </div>
                        <a class="btn btn-sm btn-outline-success"
                           href="{{ route('admin.radiology-reports.show', ['radiology_report' => $imagingService->report->id]) }}">
                            <i class="fa-solid fa-file-medical me-1"></i>Open Report
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">No report yet</div>
                            <div class="text-muted small">Create a report after the service is performed.</div>
                        </div>
                        <a class="btn btn-sm btn-outline-primary"
                           href="{{ route('admin.radiology-reports.create', ['imaging_service_id' => $imagingService->id]) }}">
                            <i class="fa-solid fa-file-circle-plus me-1"></i>Create Report
                        </a>
                    </div>
                @endif

                <div class="text-muted small">
                    Tip: ordered → performed → reported → finalize report → deliver to patient.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
