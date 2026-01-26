@extends('layouts.admin')

@section('title','Edit Service')
@section('page_title','Edit Service')
@section('page_subtitle','Update pricing and details')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Edit Service</div>
                <div class="text-muted small">#{{ $service->id }} • {{ $service->name }}</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.services.update', $service) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Service Name</label>
                            <input class="form-control" name="name" value="{{ old('name',$service->name) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Modality</label>
                            <input class="form-control" name="modality" value="{{ old('modality',$service->modality) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price (KES)</label>
                            <input class="form-control" type="number" min="0" step="1" name="price" value="{{ old('price',$service->price) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Duration (minutes)</label>
                            <input class="form-control" type="number" min="0" step="1" name="duration_minutes" value="{{ old('duration_minutes',$service->duration_minutes) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Active</label>
                            <select class="form-select" name="is_active">
                                <option value="1" @selected((string)old('is_active',$service->is_active)==='1')>Yes</option>
                                <option value="0" @selected((string)old('is_active',$service->is_active)==='0')>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Save Changes
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
