@extends('layouts.admin')

@section('title','Edit Report')
@section('page_title','Edit Radiology Report')
@section('page_subtitle','Update attachment and finalize when ready')

@section('content')
@php
    $patient = $report->imagingService->visit->patient;
    $service = $report->imagingService->service;
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Report #{{ $report->id }}</div>
                    <div class="text-muted small">
                        {{ $patient->first_name }} {{ $patient->last_name }} • {{ $service->name }}
                    </div>
                </div>
                <span class="badge {{ $report->status === 'final' ? 'text-bg-success' : 'text-bg-warning' }}">
                    {{ strtoupper($report->status) }}
                </span>
            </div>

            <div class="card-body">
                @if($report->status === 'final')
                    <div class="alert alert-info">
                        <i class="fa-solid fa-lock me-2"></i>This report is finalized and cannot be edited.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.reports.update', $report) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Report Notes (optional)</label>
                        <textarea class="form-control" name="report_text" rows="5" @disabled($report->status==='final')>{{ old('report_text', $report->report_text) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Attachment</label>

                        @if($report->attachment_path)
                            <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                <span class="badge text-bg-primary">
                                    <i class="fa-solid fa-paperclip me-1"></i>{{ $report->attachment_name ?? 'attachment' }}
                                </span>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.reports.download', $report) }}">
                                    <i class="fa-solid fa-download me-1"></i>Download
                                </a>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remove_attachment" value="1" id="remove_attachment" @disabled($report->status==='final')>
                                <label class="form-check-label" for="remove_attachment">Remove current attachment</label>
                            </div>
                        @else
                            <div class="text-muted small mb-2">No attachment uploaded yet.</div>
                        @endif

                        <input class="form-control mt-2" type="file" name="attachment" @disabled($report->status==='final')>
                        <div class="form-text">Uploading a new file replaces the old one.</div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-pd" @disabled($report->status==='final')>
                            <i class="fa-solid fa-floppy-disk me-1"></i>Save Changes
                        </button>

                        <a class="btn btn-outline-secondary" href="{{ route('admin.reports.show', $report) }}">
                            <i class="fa-solid fa-eye me-1"></i>View
                        </a>

                        <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" data-confirm="Delete this report permanently?">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" type="submit" @disabled($report->status==='final')>
                                <i class="fa-solid fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </form>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('admin.reports.finalize', $report) }}" data-confirm="Finalize this report? It will be locked for editing.">
                        @csrf
                        <button class="btn btn-success" type="submit" @disabled($report->status==='final')>
                            <i class="fa-solid fa-check me-1"></i>Finalize
                        </button>
                    </form>

                    <a class="btn btn-outline-primary" href="{{ route('admin.reports.preview', $report) }}">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>Preview
                    </a>

                    <a class="btn btn-outline-secondary" href="{{ route('admin.imaging-services.show', $report->imagingService) }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to Imaging Service
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
