@extends('layouts.admin')

@section('title','Appointments')
@section('page_title','Appointments')
@section('page_subtitle','View all patient bookings (read-only)')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Appointments</div>
                    <div class="text-muted small">Filter and open a booking</div>
                </div>

                <form class="d-flex gap-2" method="GET">
                    <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name, phone, service...">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        @foreach(['pending','confirmed','completed','cancelled','no_show'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-pd"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($appointments as $a)
                            <tr>
                                <td class="fw-semibold">{{ $a->appointment_number ?? $a->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $a->patient_name }}</div>
                                    <div class="text-muted small">{{ $a->patient_phone }} @if($a->patient_email) • {{ $a->patient_email }} @endif</div>
                                </td>
                                <td>{{ $a->service_name }}</td>
                                <td>
                                    <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($a->appointment_date)->toDateString() }}</div>
                                    <div class="text-muted small">{{ $a->appointment_time ?? '' }}</div>
                                </td>
                                <td><span class="badge badge-soft">{{ ucfirst($a->status ?? 'pending') }}</span></td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.appointments.show', $a->id) }}">
                                        <i class="fa-solid fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No appointments found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
