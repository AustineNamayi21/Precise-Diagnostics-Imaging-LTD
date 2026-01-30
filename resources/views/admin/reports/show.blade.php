@extends('layouts.admin')

@section('title','Report')
@section('page_title','Report Details')
@section('page_subtitle','Finalize and send to patient via email')

@section('content')
@php
    // Normalize variable name
    $report = $report ?? $radiologyReport ?? $radiology_report ?? null;

    $imaging = $report?->imagingService;
    $visit   = $imaging?->visit;
    $patient = $visit?->patient;
    $service = $imaging?->service;

    $reportId = $report?->id;
    $isFinal  = (($report?->status ?? 'draft') === 'final');
@endphp

@if(!$report)
    <div class="alert alert-danger">
        Report variable not provided to the view.
    </div>
@else
<div class="row g-3">

    {{-- LEFT: REPORT DETAILS --}}
    <div class="col-12 col-lg-7" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Report #{{ $reportId }}</div>
                    <div class="text-muted small">
                        @if($patient)
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        @else
                            <span class="text-danger fw-semibold">Patient not linked</span>
                        @endif

                        <span class="mx-2">•</span>

                        {{ $service?->name ?? 'Service not linked' }}
                    </div>
                </div>

                <div class="d-flex gap-2">
                    {{-- Build URL manually to avoid route binding issues --}}
                    @if(!empty($reportId))
                        <a href="{{ url('admin/radiology-reports/'.$reportId.'/edit') }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                        </a>
                    @else
                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled>
                            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                        </button>
                    @endif

                    <a href="{{ route('admin.radiology-reports.index') }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if(!$imaging || !$visit || !$patient || !$service)
                    <div class="alert alert-warning">
                        <div class="fw-semibold mb-1">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i>Incomplete Report Linkage
                        </div>
                        <div class="small">
                            This report is missing one or more links (Imaging Service / Visit / Patient / Service).
                            Some fields may show as “not linked”.
                        </div>
                    </div>
                @endif

                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check me-1"></i>{{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-xmark me-1"></i>{{ session('error') }}
                    </div>
                @endif
                @if(session('info'))
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-1"></i>{{ session('info') }}
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="text-muted small">Status</div>
                            <div class="fw-semibold">
                                <span class="badge {{ $isFinal ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ strtoupper($report->status ?? 'draft') }}
                                </span>
                            </div>
                            @if(!$isFinal)
                                <div class="text-muted small mt-2">
                                    Tip: Set status to <strong>FINAL</strong> before sending.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="text-muted small">Created</div>
                            <div class="fw-semibold">
                                {{ optional($report->created_at)->format('d M Y, H:i') ?? '—' }}
                            </div>
                        </div>
                    </div>

                    {{-- ✅ Correct: report_text --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-2">Report Notes / Findings</div>
                            <div class="text-muted" style="white-space: pre-line;">
                                {{ $report->report_text ?? '—' }}
                            </div>
                        </div>
                    </div>

                    {{-- Attachment --}}
                    <div class="col-12">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="fw-semibold mb-2">Attachment</div>

                            @if($report->attachment_path)
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <span class="badge text-bg-primary">Available</span>

                                    <a class="btn btn-sm btn-outline-primary"
                                       target="_blank"
                                       href="{{ asset('storage/'.$report->attachment_path) }}">
                                        <i class="fa-solid fa-paperclip me-1"></i>Open Attachment
                                    </a>

                                    <span class="text-muted small">{{ $report->attachment_path }}</span>
                                </div>
                                <div class="text-muted small mt-2">
                                    If the link fails, run: <code>php artisan storage:link</code>
                                </div>
                            @else
                                <span class="badge text-bg-secondary">No Attachment</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- RIGHT: SUMMARY + SEND --}}
    <div class="col-12 col-lg-5" data-aos="fade-up" data-aos-delay="100">

        {{-- Patient summary --}}
        <div class="card pd-card mb-3">
            <div class="card-header">
                <div class="fw-bold">Patient & Service Summary</div>
                <div class="text-muted small">Linked details from visit & imaging service</div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Patient</div>
                    <div class="fw-semibold">
                        {{ $patient ? ($patient->first_name.' '.$patient->last_name) : '—' }}
                    </div>
                    <div class="text-muted small">
                        {{ $patient?->phone ?? '—' }}
                        @if($patient?->email) • {{ $patient->email }} @endif
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Service</div>
                    <div class="fw-semibold">{{ $service?->name ?? '—' }}</div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Visit</div>
                    <div class="fw-semibold">
                        {{ $visit?->id ? ('Visit #'.$visit->id) : '—' }}
                    </div>
                    <div class="text-muted small">
                        {{ $visit?->visit_date ?? '—' }}
                    </div>
                </div>

                <div class="mb-0">
                    <div class="text-muted small">Imaging Service</div>
                    <div class="fw-semibold">
                        {{ $imaging?->id ? ('Imaging #'.$imaging->id) : '—' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ✅ Send Report Email Template --}}
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Send Report to Patient</div>
                <div class="text-muted small">Email the attachment to the patient</div>
            </div>

            <div class="card-body">
                @if(!$isFinal)
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i>
                        This report is not <strong>FINAL</strong>. Finalize it before sending.
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.radiology-reports.send', ['radiologyReport' => $reportId]) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Recipient Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $patient?->email) }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="patient@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            If the patient email is missing, type it here.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Optional Message</label>
                        <textarea name="message"
                                  rows="4"
                                  class="form-control @error('message') is-invalid @enderror"
                                  placeholder="Write a short note to the patient...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn btn-pd w-100"
                            {{ $isFinal ? '' : 'disabled' }}>
                        <i class="fa-solid fa-paper-plane me-1"></i>
                        Send Report
                    </button>

                    @if(!$report->attachment_path)
                        <div class="text-danger small mt-2">
                            <i class="fa-solid fa-circle-xmark me-1"></i>
                            No attachment is uploaded. Upload the report file before sending.
                        </div>
                    @endif
                </form>

                <div class="text-muted small mt-3">
                    After sending, check <strong>Deliveries</strong> to see status (sent/failed) and error messages.
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@endsection
