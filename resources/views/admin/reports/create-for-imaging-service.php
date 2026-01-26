@extends('layouts.admin')

@section('title','Create Report')
@section('page_title','Create Radiology Report')
@section('page_subtitle','1 report per imaging service (traceable & secure)')

@section('content')
@php
    $patient = $imagingService->visit->patient;
    $service = $imagingService->service;
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">New Report</div>
                <div class="text-muted small">
                    Patient: <strong>{{ $patient->first_name }} {{ $patient->last_name }}</strong> • Service: <strong>{{ $service->name }}</strong>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.reports.store.for-imaging-service', $imagingService) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Report Notes (optional)</label>
                        <textarea class="form-control" name="report_text" rows="5" placeholder="Enter clinical findings or remarks...">{{ old('report_text') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Report File (PDF/DOC/DOCX)</label>
                        <input class="form-control" type="file" name="attachment" required>
                        <div class="form-text">This attachment is what will be emailed to the patient.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Create Report
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.imaging-services.show', $imagingService) }}">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
