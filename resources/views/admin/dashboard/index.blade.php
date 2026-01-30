@extends('layouts.admin')

@section('title','Dashboard')
@section('page_title','Admin Dashboard')
@section('page_subtitle','Quick overview of clinic activity')

@section('content')
@php
    $kpis = $kpis ?? [
        'patients' => $patientsCount ?? 0,
        'visits_today' => $visitsToday ?? 0,
        'imaging_today' => $imagingToday ?? 0,
        'reports_draft' => $draftReports ?? 0,
        'reports_final' => $finalReports ?? 0,
        'revenue_today' => $revenueToday ?? 0,
    ];

    $recentAppointments = $recentAppointments ?? collect();
    $recentReports = $recentReports ?? collect();
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">Patients</div>
                            <div class="display-6 fw-bold" data-counter="{{ (int)$kpis['patients'] }}">0</div>
                            <div class="text-muted small">Registered patients</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">Visits Today</div>
                            <div class="display-6 fw-bold" data-counter="{{ (int)$kpis['visits_today'] }}">0</div>
                            <div class="text-muted small">{{ now()->toDateString() }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-light">
                            <div class="text-muted small">Revenue Today</div>
                            <div class="display-6 fw-bold" data-counter="{{ (float)$kpis['revenue_today'] }}" data-prefix="KES " data-suffix="">0</div>
                            <div class="text-muted small">Payments collected</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-white">
                            <div class="text-muted small">Imaging Services Today</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (int)$kpis['imaging_today'] }}">0</div>
                            <div class="text-muted small">Ordered / performed</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-white">
                            <div class="text-muted small">Draft Reports</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (int)$kpis['reports_draft'] }}">0</div>
                            <div class="text-muted small">Not finalized</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-4 border bg-white">
                            <div class="text-muted small">Final Reports</div>
                            <div class="h2 fw-bold mb-0" data-counter="{{ (int)$kpis['reports_final'] }}">0</div>
                            <div class="text-muted small">Ready for sending</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="col-12 col-lg-6" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold"><i class="fa-solid fa-calendar-check me-2"></i>Recent Appointments</div>
                    <div class="text-muted small">Latest public bookings</div>
                </div>
                @if(Route::has('admin.appointments.index'))
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.appointments.index') }}">View all</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentAppointments as $a)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $a->patient_name }}</div>
                                    <div class="text-muted small">{{ $a->patient_phone }}</div>
                                </td>
                                <td>{{ $a->service_name }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($a->appointment_date)->toDateString() }}</td>
                                <td><span class="badge badge-soft">{{ ucfirst($a->status ?? 'pending') }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No recent appointments.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reports -->
    <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="50">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold"><i class="fa-solid fa-file-medical me-2"></i>Recent Reports</div>
                    <div class="text-muted small">Latest created/updated reports</div>
                </div>

                {{-- ✅ Fast Fix: correct route name + never crash --}}
                @if(Route::has('admin.radiology-reports.index'))
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.radiology-reports.index') }}">View all</a>
                @endif
            </div>

            <div class="card-body">
                <div class="list-group">
                    @forelse($recentReports as $r)
                        @php
                            $p = $r->imagingService?->visit?->patient;
                            $s = $r->imagingService?->service;
                        @endphp

                        {{-- ✅ Fast Fix: correct show route + never crash --}}
                        @if(Route::has('admin.radiology-reports.show'))
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
                               href="{{ route('admin.radiology-reports.show', $r) }}">
                                <div>
                                    <div class="fw-semibold">
                                        Report #{{ $r->id }} • {{ $p?->first_name }} {{ $p?->last_name }}
                                    </div>
                                    <div class="text-muted small">{{ $s?->name ?? '—' }}</div>
                                </div>
                                <span class="badge {{ $r->status==='final' ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ strtoupper($r->status) }}
                                </span>
                            </a>
                        @else
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">
                                        Report #{{ $r->id }} • {{ $p?->first_name }} {{ $p?->last_name }}
                                    </div>
                                    <div class="text-muted small">{{ $s?->name ?? '—' }}</div>
                                </div>
                                <span class="badge {{ $r->status==='final' ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ strtoupper($r->status) }}
                                </span>
                            </div>
                        @endif
                    @empty
                        <div class="text-muted">No recent reports.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
