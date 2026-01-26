@extends('layouts.admin')

@section('title','New Patient')
@section('page_title','Register Patient')
@section('page_subtitle','Create a new patient profile')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-8" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">New Patient</div>
                <div class="text-muted small">Fill in details carefully</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.patients.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name</label>
                            <input class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input class="form-control" name="phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email (optional)</label>
                            <input class="form-control" name="email" value="{{ old('email') }}" type="email">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">DOB (optional)</label>
                            <input class="form-control" name="dob" value="{{ old('dob') }}" type="date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Gender (optional)</label>
                            <select class="form-select" name="gender">
                                <option value="">Select</option>
                                @foreach(['male','female','other'] as $g)
                                    <option value="{{ $g }}" @selected(old('gender')===$g)>{{ ucfirst($g) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Address (optional)</label>
                            <input class="form-control" name="address" value="{{ old('address') }}">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-pd">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Save Patient
                        </button>
                        <a class="btn btn-outline-secondary" href="{{ route('admin.patients.index') }}">
                            <i class="fa-solid fa-arrow-left me-1"></i>Back
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
