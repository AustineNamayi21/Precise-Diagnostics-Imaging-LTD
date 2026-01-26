@extends('layouts.admin')

@section('title','New Service')
@section('page_title','Create Service')
@section('page_subtitle','Add a new imaging procedure')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">New Service</div>
                <div class="text-muted small">Set modality, price, and duration</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.services.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Service Name</label>
                            <input class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Modality</label>
                            <select class="form-select" name="modality">
                                <option value="">Select</option>
                                @foreach(['X-ray','Ultrasound','CT','MRI','Mammography','Fluoroscopy','Other'] as $m)
                                    <option value="{{ $m }}" @selected(old('modality')===$m)>{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price (KES)</label>
                            <input class="form-control" type="number" min="0" step="1" name="price" value="{{ old('price',0) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Duration (minutes)</label>
                            <input class="form-control" type="number" min="0" step="1" name="duration_minutes" value="{{ old('duration_minutes',0) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Active</label>
                            <select class="form-select" name="is_active">
                                <option value="1" @selected(old('is_active','1')==='1')>Yes</option>
                                <option value="0" @selected(old('is_active')==='0')>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Save Service
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.services.index') }}">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
