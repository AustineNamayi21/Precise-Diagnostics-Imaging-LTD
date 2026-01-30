@extends('layouts.admin')

@section('title', 'Radiology Report')
@section('page_title', 'Radiology Report')
@section('page_subtitle', 'View report details and send to patient')

@section('content')
<div class="row g-3">

    {{-- LEFT: REPORT DETAILS --}}
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Report #{{ $report->id }}</div>
                    <div class="text-muted small">
                        Status:
                        <span class="badge
                            {{ $report->status === 'final' ? 'text-bg-success' : 'text-bg-warning' }}">
                            {{ strtoupper($report->status ?? 'draft') }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('admin.radiology-reports.index') }}"
                   class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>

            <div class="card-body">

                {{-- PATIENT INFO --}}
                <div class="mb-3">
                    <div class="text-muted small">Patient</div>
                    <div class="fw-semibold">
                        {{ $report->imagingService?->visit?->patient?->full_name
                            ?? $report->imagingService?->visit?->patient?->name
                            ?? '—' }}
                    </div>
                    <div class="text-muted small">
                        {{ $report->imagingService?->visit?->patient?->email ?? 'No email on record' }}
                    </div>
                </div>

                {{-- SERVICE INFO --}}
                <div class="mb-3">
                    <div class="text-muted small">Imaging Service</div>
                    <div class="fw-semibold">
                        {{ $report->imagingService?->service?->name ?? '—' }}
                    </div>
                </div>

                {{-- REPORT TEXT --}}
                <div class="mb-3">
                    <div class="text-muted small mb-1">Report Notes / Findings</div>
                    <div class="border rounded-3 p-3 bg-light">
                        {!! nl2br(e($report->report_text ?? '—')) !!}
                    </div>
                </div>

                {{-- ATTACHMENT --}}
                <div class="mb-3">
                    <div class="text-muted small mb-1">Attachment</div>

                    @if($report->attachment_path)
                        <a href="{{ asset('storage/'.$report->attachment_path) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-paperclip me-1"></i>
                            View Attachment
                        </a>
                    @else
                        <div class="text-muted">No attachment uploaded</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- RIGHT: SEND REPORT --}}
    <div class="col-12 col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card pd-card h-100">
            <div class="card-header">
                <div class="fw-bold">Send Report to Patient</div>
                <div class="text-muted small">
                    Only <strong>FINAL</strong> reports can be emailed
                </div>
            </div>

            <div class="card-body">

                {{-- STATUS WARNING --}}
                @if(($report->status ?? 'draft') !== 'final')
                    <div class="alert alert-warning">
                        This report is currently <strong>{{ strtoupper($report->status ?? 'draft') }}</strong>.
                        <br>
                        Set the status to <strong>FINAL</strong> before sending.
                    </div>
                @endif

                {{-- FLASH MESSAGES --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- SEND FORM --}}
                <form method="POST"
                      action="{{ route('admin.radiology-reports.send', ['radiologyReport' => $report->id]) }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Recipient Email
                        </label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Leave blank to use patient email"
                               value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            If empty, system will use the patient’s email (if available).
                        </div>
                    </div>

                    {{-- MESSAGE --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Optional Message
                        </label>
                        <textarea name="message"
                                  rows="4"
                                  class="form-control @error('message') is-invalid @enderror"
                                  placeholder="Optional message to the patient...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SEND BUTTON --}}
                    <button type="submit"
                            class="btn btn-pd w-100"
                            {{ (($report->status ?? 'draft') !== 'final') ? 'disabled' : '' }}>
                        <i class="fa-solid fa-paper-plane me-1"></i>
                        Send Report
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
