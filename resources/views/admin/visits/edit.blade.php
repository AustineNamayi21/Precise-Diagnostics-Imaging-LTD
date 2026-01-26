@extends('layouts.admin')

@section('title','Edit Visit')
@section('page_title','Edit Visit')
@section('page_subtitle','Update visit status and details')

@section('content')
@php
    $patients = $patients ?? [];
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Edit Visit</div>
                <div class="text-muted small">#{{ $visit->id }}</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.visits.update', $visit) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Patient</label>
                            <select class="form-select" name="patient_id" required>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}" @selected(old('patient_id',$visit->patient_id)==$p->id)>
                                        {{ $p->first_name }} {{ $p->last_name }} • {{ $p->phone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Visit Date</label>
                            <input class="form-control" type="date" name="visit_date"
                                   value="{{ old('visit_date', \Illuminate\Support\Carbon::parse($visit->visit_date)->toDateString()) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                @foreach(['scheduled','in_progress','completed','cancelled'] as $s)
                                    <option value="{{ $s }}" @selected(old('status',$visit->status)===$s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Notes (optional)</label>
                            <input class="form-control" name="notes" value="{{ old('notes', $visit->notes) }}">
                        </div>
                    </div>

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Save
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.visits.show', $visit) }}">
                            <i class="fa-solid fa-eye me-1"></i>View
                        </a>
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
