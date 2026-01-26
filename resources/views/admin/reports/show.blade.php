@extends('layouts.admin')

@section('title','Report')
@section('page_title','Report Details')
@section('page_subtitle','Finalize and send to patient via email')

@section('content')
@php
    $patient = $report->imagingService->visit->patient;
    $service = $report->imagingService->service;
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-7" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Report #{{ $report->id }}</div>
                    <div class="text-muted small">{{ $patient->first_name }} {{ $patient->last_name }} • {{ $service->name }}</div>
                </div>

                <span class="badge {{ $report->status === 'final' ? 'text-bg-success' : 'text-bg-warning' }}">
                    {{ strtoupper($report->status) }}
                </span>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <div class="text-muted small">Patient Email</div>
                    <div class="fw-semibold">{{ $patient->email ?? '— (missing)' }}</div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Attachment</div>
                    @if($report->attachment_path)
                        <div class="d-flex gap-2 align-items-center flex-wrap">
                            <span class="badge text-bg-primary">
                                <i class="fa-solid fa-paperclip me-1"></i>{{ $report->attachment_name ?? 'attachment' }}
                            </span>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.reports.download', $report) }}">
                                <i class="fa-solid fa-download me-1"></i>Download
                            </a>
                        </div>
                    @else
                        <div class="text-muted">No attachment uploaded.</div>
                    @endif
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Notes</div>
                    <div class="border rounded-4 p-3 bg-light">
                        {!! nl2br(e($report->report_text ?? '—')) !!}
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.reports.edit', $report) }}">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>

                    <form method="POST" action="{{ route('admin.reports.finalize', $report) }}" data-confirm="Finalize this report? It will be locked for editing.">
                        @csrf
                        <button class="btn btn-success" type="submit" @disabled($report->status==='final')>
                            <i class="fa-solid fa-check me-1"></i>Finalize
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Send panel -->
    <div class="col-12 col-lg-5" data-aos="fade-up" data-aos-delay="80">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold"><i class="fa-solid fa-paper-plane me-2"></i>Send Report</div>
                <div class="text-muted small">Requires FINAL + attachment + patient email</div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.reports.send', $report) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Override Email (optional)</label>
                        <input class="form-control" name="email" value="{{ old('email') }}" placeholder="Leave blank to use patient email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Custom Message (optional)</label>
                        <textarea class="form-control" name="message" rows="4" placeholder="Optional message to patient...">{{ old('message') }}</textarea>
                    </div>

                    <button class="btn btn-pd w-100"
                            @disabled($report->status!=='final' || !$report->attachment_path)>
                        <i class="fa-solid fa-envelope me-2"></i>Send to Patient
                    </button>

                    @if($report->status !== 'final')
                        <div class="text-muted small mt-2">Finalize the report before sending.</div>
                    @elseif(!$report->attachment_path)
                        <div class="text-muted small mt-2">Upload an attachment before sending.</div>
                    @endif
                </form>

                <hr class="my-4">

                <div class="fw-bold mb-2">Delivery History</div>
                <div class="small text-muted mb-2">All attempts are logged.</div>

                <div class="list-group">
                    @forelse($report->deliveries as $d)
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-semibold">
                                    {{ $d->sent_to_email }}
                                    @if($d->status==='sent')
                                        <span class="badge text-bg-success ms-2">SENT</span>
                                    @else
                                        <span class="badge text-bg-danger ms-2">FAILED</span>
                                    @endif
                                </div>
                                <div class="text-muted small">
                                    {{ $d->sent_at ? \Illuminate\Support\Carbon::parse($d->sent_at)->format('Y-m-d H:i') : '—' }}
                                    @if($d->sender) • by {{ $d->sender->name }} @endif
                                </div>
                                @if($d->status==='failed' && $d->error_message)
                                    <div class="text-danger small mt-1">{{ $d->error_message }}</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">No deliveries yet.</div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
