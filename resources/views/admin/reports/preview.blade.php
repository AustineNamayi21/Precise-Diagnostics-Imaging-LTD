@extends('layouts.admin')

@section('title','Preview Report')
@section('page_title','Report Preview')
@section('page_subtitle','Quick review before sending')

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
                    <div class="text-muted small">{{ $patient->first_name }} {{ $patient->last_name }} • {{ $service->name }}</div>
                </div>
                <span class="badge {{ $report->status==='final' ? 'text-bg-success' : 'text-bg-warning' }}">{{ strtoupper($report->status) }}</span>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Notes</div>
                    <div class="border rounded-4 p-3 bg-light">
                        {!! nl2br(e($report->report_text ?? '—')) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Attachment</div>
                    @if($report->attachment_path)
                        <a class="btn btn-outline-primary" href="{{ route('admin.reports.download', $report) }}">
                            <i class="fa-solid fa-download me-1"></i>Download Attachment
                        </a>
                    @else
                        <div class="text-muted">No attachment uploaded.</div>
                    @endif
                </div>

                <a class="btn btn-outline-secondary" href="{{ route('admin.reports.show', $report) }}">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
