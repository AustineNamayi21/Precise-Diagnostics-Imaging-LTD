@extends('layouts.admin')

@section('title','Appointment')
@section('page_title','Appointment Details')
@section('page_subtitle','Review booking details')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">
                    Booking: {{ $appointment->appointment_number ?? $appointment->id }}
                </div>
                <span class="badge badge-soft">{{ ucfirst($appointment->status ?? 'pending') }}</span>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="text-muted small">Patient</div>
                        <div class="fw-semibold">{{ $appointment->patient_name }}</div>
                        <div class="text-muted small">{{ $appointment->patient_phone }} @if($appointment->patient_email) • {{ $appointment->patient_email }} @endif</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Service</div>
                        <div class="fw-semibold">{{ $appointment->service_name }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Date</div>
                        <div class="fw-semibold">{{ \Illuminate\Support\Carbon::parse($appointment->appointment_date)->toDateString() }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Time</div>
                        <div class="fw-semibold">{{ $appointment->appointment_time ?? '—' }}</div>
                    </div>
                </div>

                <hr class="my-4">

                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
