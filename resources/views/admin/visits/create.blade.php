@extends('layouts.admin')

@section('title','New Visit')
@section('page_title','Create Visit')
@section('page_subtitle','Link visit to a patient then attach services')

@section('content')
@php
    $patients = $patients ?? [];
    $selectedPatientId = old('patient_id', request('patient_id'));
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">New Visit</div>
                <div class="text-muted small">Step 1: Select patient and visit date</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.visits.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Patient</label>
                            <select class="form-select" name="patient_id" required>
                                <option value="">Select patient...</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}" @selected((string)$selectedPatientId === (string)$p->id)>
                                        {{ $p->first_name }} {{ $p->last_name }} • {{ $p->phone }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                If the patient is missing, create them first in Patients.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Visit Date</label>
                            <input class="form-control" type="date" name="visit_date" value="{{ old('visit_date', now()->toDateString()) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                @foreach(['scheduled','in_progress','completed','cancelled'] as $s)
                                    <option value="{{ $s }}" @selected(old('status','scheduled')===$s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Notes (optional)</label>
                            <input class="form-control" name="notes" value="{{ old('notes') }}" placeholder="Clinical notes / reason...">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Create Visit
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.visits.index') }}">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
