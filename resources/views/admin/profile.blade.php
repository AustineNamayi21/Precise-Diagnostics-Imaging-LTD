@extends('layouts.admin')


@section('title', 'Profile')
@section('page_title', 'My Profile')
@section('page_subtitle', 'View your account details')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card pd-card">
            <div class="card-body text-center p-4">
                <div class="mb-3" style="font-size:48px;">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <h5 class="mb-1">{{ auth()->user()->name ?? 'User' }}</h5>
                <div class="text-muted small">{{ auth()->user()->email ?? 'No email' }}</div>

                <hr class="my-4">

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <i class="fa-solid fa-gauge-high me-1"></i> Back to Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger w-100" type="submit">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card pd-card">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fa-solid fa-id-card me-2"></i> Account Details
                </h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Full Name</label>
                        <div class="form-control bg-light">{{ auth()->user()->name ?? '—' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small">Email Address</label>
                        <div class="form-control bg-light">{{ auth()->user()->email ?? '—' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small">User ID</label>
                        <div class="form-control bg-light">{{ auth()->id() ?? '—' }}</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small">Member Since</label>
                        <div class="form-control bg-light">
                            {{ optional(auth()->user()->created_at)->format('d M Y, H:i') ?? '—' }}
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4 mb-0">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Profile editing can be added later (change name, password, etc). For now this page confirms your account session is working.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
