@extends('layouts.admin')

@section('title','Finance')
@section('page_title','Finance Dashboard')
@section('page_subtitle','Revenue summaries and trends')

@section('content')
@php
    $kpis = $kpis ?? [
        'today' => $todayRevenue ?? 0,
        'week' => $weekRevenue ?? 0,
        'month' => $monthRevenue ?? 0,
        'year' => $yearRevenue ?? 0,
    ];
    $chartLabels = $chartLabels ?? [];
    $chartValues = $chartValues ?? [];
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-3">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">Today</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (float)$kpis['today'] }}" data-prefix="KES ">0</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">This Week</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (float)$kpis['week'] }}" data-prefix="KES ">0</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">This Month</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (float)$kpis['month'] }}" data-prefix="KES ">0</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">This Year</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (float)$kpis['year'] }}" data-prefix="KES ">0</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-primary" href="{{ route('admin.finance.reports.daily') }}"><i class="fa-solid fa-calendar-day me-1"></i>Daily</a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.finance.reports.weekly') }}"><i class="fa-solid fa-calendar-week me-1"></i>Weekly</a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.finance.reports.monthly') }}"><i class="fa-solid fa-calendar me-1"></i>Monthly</a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.finance.reports.yearly') }}"><i class="fa-solid fa-calendar-days me-1"></i>Yearly</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12" data-aos="fade-up" data-aos-delay="50">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold"><i class="fa-solid fa-chart-line me-2"></i>Revenue Trend</div>
                <div class="text-muted small">Recent period summary</div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
    const labels = @json($chartLabels);
    const values = @json($chartValues);

    const ctx = document.getElementById('revenueChart');
    if (!ctx || !window.Chart) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (KES)',
                data: values,
                tension: 0.25,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
})();
</script>
@endpush
