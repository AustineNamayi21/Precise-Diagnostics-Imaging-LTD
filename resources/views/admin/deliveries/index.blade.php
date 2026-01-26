@extends('layouts.admin')

@section('title','Deliveries')
@section('page_title','Report Deliveries')
@section('page_subtitle','Email history and delivery audit trail')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Deliveries</div>
                    <div class="text-muted small">Every send attempt is logged</div>
                </div>

                <form class="d-flex gap-2" method="GET" action="{{ route('admin.deliveries.index') }}">
                    <input class="form-control" type="date" name="date" value="{{ request('date') }}">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        @foreach(['sent','failed'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-pd"><i class="fa-solid fa-filter me-1"></i>Filter</button>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Sent To</th>
                            <th>Report</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Sent At</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($deliveries as $d)
                            @php
                                $report = $d->report;
                                $img = $report?->imagingService;
                                $patient = $img?->visit?->patient;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $d->sent_to_email }}</td>
                                <td>
                                    @if($report)
                                        <a class="text-decoration-none" href="{{ route('admin.reports.show', $report) }}">
                                            Report #{{ $report->id }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $patient?->first_name }} {{ $patient?->last_name }}</div>
                                    <div class="text-muted small">{{ $patient?->phone }}</div>
                                </td>
                                <td>
                                    @if($d->status === 'sent')
                                        <span class="badge text-bg-success">SENT</span>
                                    @else
                                        <span class="badge text-bg-danger">FAILED</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $d->sent_at ? \Illuminate\Support\Carbon::parse($d->sent_at)->format('Y-m-d H:i') : '—' }}</td>
                                <td class="text-end">
                                    @if($report)
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.reports.show', $report) }}">
                                            <i class="fa-solid fa-eye me-1"></i>View Report
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @if($d->status === 'failed' && $d->error_message)
                                <tr>
                                    <td colspan="6" class="text-danger small">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $d->error_message }}
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No deliveries found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $deliveries->links() ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection
