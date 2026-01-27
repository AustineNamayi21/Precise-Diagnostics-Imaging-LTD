@extends('layouts.admin')

@section('title','Create Report')
@section('page_title','Create Radiology Report')
@section('page_subtitle','Upload the PDF/DOC report for this imaging service')

@section('content')
@php
    $visit = $imagingService->visit;
    $patient = $visit?->patient;
    $service = $imagingService->service;
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">
                        <i class="fa-solid fa-file-circle-plus me-2"></i>
                        New Report
                    </div>
                    <div class="text-muted small">
                        {{ $patient?->first_name }} {{ $patient?->last_name }}
                        • Visit #{{ $visit?->id ?? '—' }}
                        • {{ $service?->name ?? '—' }}
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.imaging-services.show', $imagingService) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="alert alert-info" role="alert" data-aos="zoom-in">
                    <div class="d-flex gap-2 align-items-start">
                        <i class="fa-solid fa-shield-halved mt-1"></i>
                        <div>
                            <div class="fw-semibold">Tip</div>
                            <div class="small mb-0">
                                Upload the report as <strong>PDF</strong> or <strong>DOC/DOCX</strong>.
                                After saving, you can finalize it and send to the patient.
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST"
                      action="{{ route('admin.reports.store.for-imaging-service', $imagingService) }}"
                      enctype="multipart/form-data"
                      class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label class="form-label">Report Notes (optional)</label>
                        <textarea name="report_text" rows="5"
                                  class="form-control @error('report_text') is-invalid @enderror"
                                  placeholder="Short summary / internal notes…">{{ old('report_text') }}</textarea>
                        @error('report_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Upload Report File <span class="text-danger">*</span></label>
                        <input type="file"
                               name="attachment"
                               class="form-control @error('attachment') is-invalid @enderror"
                               required>
                        <div class="form-text">Accepted: PDF, DOC, DOCX (max 10MB).</div>
                        @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('admin.imaging-services.show', $imagingService) }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
