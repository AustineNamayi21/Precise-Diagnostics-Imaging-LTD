@extends('layouts.admin')

@section('title','Imaging Service')
@section('page_title','Imaging Service')
@section('page_subtitle','Manage status and create/report workflow')

@section('content')
@php
    $visit = $imagingService->visit;
    $patient = $visit?->patient;
    $service = $imagingService->service;
    $report = $imagingService->report;
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-6" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">Imaging Service #{{ $imagingService->id }}</div>
                <span class="badge badge-soft">{{ ucfirst($imagingService->status ?? 'ordered') }}</span>
            </div>

            <div class="card-body">
                <div class="mb-2 text-muted small">Patient</div>
                <div class="fw-bold h5 mb-1">{{ $patient?->first_name }} {{ $patient?->last_name }}</div>
                <div class="text-muted small">{{ $patient?->phone }} @if($patient?->email) • {{ $patient->email }} @endif</div>

                <hr>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-muted small">Service</div>
                        <div class="fw-semibold">{{ $service?->name ?? '—' }}</div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Price</div>
                        <div class="fw-semibold">KES {{ number_format($service?->price ?? 0) }}</div>
                    </div>

                    <div class="col-6">
                        <div class="text-muted small">Visit</div>
                        <div class="fw-semibold">
                            <a class="text-decoration-none" href="{{ route('admin.visits.show', $visit) }}">Visit #{{ $visit?->id }}</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small">Visit Date</div>
                        <div class="fw-semibold">{{ $visit?->visit_date ? \Illuminate\Support\Carbon::parse($visit->visit_date)->toDateString() : '—' }}</div>
                    </div>
                </div>

                <hr class="my-4">

                <form method="POST" action="{{ route('admin.imaging-services.update-status', $imagingService) }}">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex gap-2 align-items-end flex-wrap">
                        <div class="flex-grow-1">
                            <label class="form-label fw-semibold">Update Status</label>
                            <select class="form-select" name="status">
                                @foreach(['ordered','performed','reported','cancelled'] as $st)
                                    <option value="{{ $st }}" @selected($imagingService->status===$st)>{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-arrows-rotate me-1"></i>Update
                        </button>
                    </div>
                </form>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.imaging-services.index') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.patients.show', $patient) }}">
                        <i class="fa-solid fa-user me-1"></i>Patient
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Report panel -->
    <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="60">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold"><i class="fa-solid fa-file-medical me-2"></i>Radiology Report</div>
                <div class="text-muted small">1 report per imaging service</div>
            </div>

            <div class="card-body">
                @if($report)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <div class="fw-semibold">Report #{{ $report->id }}</div>
                            <div class="text-muted small">Status: {{ strtoupper($report->status) }}</div>
                        </div>
                        <a class="btn btn-outline-primary" href="{{ route('admin.reports.show', $report) }}">
                            <i class="fa-solid fa-eye me-1"></i>Open Report
                        </a>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-2"></i>No report yet. Create one to upload the PDF/DOC file.
                    </div>
                    <a class="btn btn-pd w-100" href="{{ route('admin.reports.create.for-imaging-service', $imagingService) }}">
                        <i class="fa-solid fa-file-circle-plus me-2"></i>Create Report
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
