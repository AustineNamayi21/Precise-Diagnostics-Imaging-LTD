@extends('layouts.admin')

@section('title','Daily Report')
@section('page_title','Daily Finance Report')
@section('page_subtitle','Revenue totals per day')

@section('content')
@php
    $rows = $rows ?? collect();
    $total = $total ?? 0;
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">Daily Revenue</div>
                    <div class="text-muted small">Sum of payments grouped by date</div>
                </div>
                <div class="fw-bold">Total: KES {{ number_format($total) }}</div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th class="text-end">Revenue (KES)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rows as $r)
                            <tr>
                                <td class="fw-semibold">{{ $r->date ?? $r['date'] ?? '—' }}</td>
                                <td class="text-end fw-semibold">{{ number_format($r->total ?? $r['total'] ?? 0) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-muted py-4">No data.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <a class="btn btn-outline-secondary" href="{{ route('admin.finance.dashboard') }}">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
