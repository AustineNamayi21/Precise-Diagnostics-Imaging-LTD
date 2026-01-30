@extends('layouts.admin')

@section('title','Deliveries')
@section('page_title','Report Deliveries')
@section('page_subtitle','Track sent reports and delivery status')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Deliveries</div>
                    <div class="text-muted small">All report delivery records</div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.report-deliveries.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-rotate me-1"></i> Refresh
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Report</th>
                            <th>Recipient Email</th>
                            <th>Sent By</th>
                            <th>Status</th>
                            <th>Sent At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($deliveries as $d)
                            <tr>
                                <td class="fw-semibold">#{{ $d->id }}</td>

                                <td>
                                    @if($d->report)
                                        <a class="text-decoration-none"
                                           href="{{ route('admin.radiology-reports.show', ['radiology_report' => $d->report->id]) }}">
                                            Report #{{ $d->report->id }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $d->sent_to_email ?? '—' }}</div>
                                    @if($d->error_message)
                                        <div class="text-danger small mt-1">
                                            {{ \Illuminate\Support\Str::limit($d->error_message, 60) }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $d->sender?->name ?? '—' }}</div>
                                    <div class="text-muted small">{{ $d->sender?->email ?? '' }}</div>
                                </td>

                                <td>
                                    <span class="badge
                                        {{ ($d->status ?? '') === 'sent' ? 'text-bg-success' : (($d->status ?? '') === 'failed' ? 'text-bg-danger' : 'text-bg-warning') }}">
                                        {{ strtoupper($d->status ?? 'pending') }}
                                    </span>
                                </td>

                                <td class="text-muted small">
                                    {{ $d->sent_at ? $d->sent_at->toDayDateTimeString() : '—' }}
                                </td>

                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary"
                                       href="{{ route('admin.report-deliveries.show', ['report_delivery' => $d->id]) }}">
                                        <i class="fa-solid fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No deliveries found yet.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($deliveries, 'links'))
                    {{ $deliveries->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
