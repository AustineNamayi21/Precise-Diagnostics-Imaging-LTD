@extends('layouts.admin')

@section('title','Edit Report')
@section('page_title','Edit Radiology Report')
@section('page_subtitle','Update report notes and attachment')

@section('content')
@php
    $imagingService = $report->imagingService ?? null;
    $visit = $imagingService?->visit;
    $patient = $visit?->patient;
    $service = $imagingService?->service;
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">
                        <i class="fa-solid fa-file-pen me-2"></i>
                        Edit Report #{{ $report->id }}
                    </div>
                    <div class="text-muted small">
                        {{ $patient?->first_name }} {{ $patient?->last_name }}
                        @if($visit) • Visit #{{ $visit->id }} @endif
                        @if($service) • {{ $service->name }} @endif
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.radiology-reports.show', ['radiology_report' => $report->id]) }}"
                       class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.radiology-reports.update', ['radiology_report' => $report->id]) }}"
                      enctype="multipart/form-data"
                      class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label fw-semibold">Report Notes / Text</label>
                        <textarea name="report_text"
                                  rows="6"
                                  class="form-control @error('report_text') is-invalid @enderror"
                                  placeholder="Write report notes or summary...">{{ old('report_text', $report->report_text) }}</textarea>
                        @error('report_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach(['draft','final'] as $st)
                                <option value="{{ $st }}" @selected(old('status', $report->status) === $st)>
                                    {{ strtoupper($st) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Replace Attachment (optional)</label>
                        <input type="file"
                               name="attachment"
                               class="form-control @error('attachment') is-invalid @enderror">
                        <div class="form-text">Accepted: PDF, DOC, DOCX, JPG, PNG (max 10MB).</div>
                        @error('attachment')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        @if($report->attachment_path)
                            <div class="mt-2 small">
                                <span class="text-muted">Current file:</span>
                                <a href="{{ asset('storage/'.$report->attachment_path) }}" target="_blank" class="text-decoration-none">
                                    <i class="fa-solid fa-paperclip me-1"></i>Open Attachment
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 d-flex flex-wrap gap-2 justify-content-end mt-2">
                        <a href="{{ route('admin.radiology-reports.show', ['radiology_report' => $report->id]) }}"
                           class="btn btn-outline-secondary">
                            Cancel
                        </a>

                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
