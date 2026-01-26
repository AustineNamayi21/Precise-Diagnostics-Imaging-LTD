<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | {{ config('app.name', 'Precise Diagnostics Imaging') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- App Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="admin-body">

<div class="admin-shell">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div class="brand-mark">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <div class="brand-text">
                <div class="brand-title">{{ config('app.name', 'Precise Diagnostics') }}</div>
                <div class="brand-sub">Admin Portal</div>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            <div class="user-meta">
                <div class="user-name">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="user-role">Authenticated</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
            </a>

            <div class="nav-section">Clinical</div>

            <a class="nav-link @if(request()->routeIs('admin.patients.*')) active @endif" href="{{ route('admin.patients.index') }}">
                <i class="fa-solid fa-users me-2"></i> Patients
            </a>

            <a class="nav-link @if(request()->routeIs('admin.visits.*')) active @endif" href="{{ route('admin.visits.index') }}">
                <i class="fa-solid fa-hospital-user me-2"></i> Visits
            </a>

            <a class="nav-link @if(request()->routeIs('admin.imaging-services.*')) active @endif" href="{{ route('admin.imaging-services.index') }}">
                <i class="fa-solid fa-x-ray me-2"></i> Imaging Services
            </a>

            <a class="nav-link @if(request()->routeIs('admin.reports.*')) active @endif" href="{{ route('admin.reports.index') }}">
                <i class="fa-solid fa-file-medical me-2"></i> Reports
            </a>

            <a class="nav-link @if(request()->routeIs('admin.deliveries.*')) active @endif" href="{{ route('admin.deliveries.index') }}">
                <i class="fa-solid fa-paper-plane me-2"></i> Deliveries
            </a>

            <div class="nav-section">Operations</div>

            <a class="nav-link @if(request()->routeIs('admin.appointments.*')) active @endif" href="{{ route('admin.appointments.index') }}">
                <i class="fa-solid fa-calendar-check me-2"></i> Appointments
            </a>

            <a class="nav-link @if(request()->routeIs('admin.services.*')) active @endif" href="{{ route('admin.services.index') }}">
                <i class="fa-solid fa-list-check me-2"></i> Services Catalog
            </a>

            <a class="nav-link @if(request()->routeIs('admin.finance.*')) active @endif" href="{{ route('admin.finance.dashboard') }}">
                <i class="fa-solid fa-coins me-2"></i> Finance
            </a>

            <div class="nav-section">Account</div>

            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fa-solid fa-id-badge me-2"></i> Profile
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                </button>
            </form>
        </nav>

        <div class="sidebar-footer">
            <small class="text-white-50">© {{ date('Y') }} Precise Diagnostics</small>
        </div>
    </aside>

    <!-- Main -->
    <main class="admin-main">
        <!-- Topbar -->
        <header class="admin-topbar">
            <button class="btn btn-sm btn-outline-light d-lg-none" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="topbar-title">
                <div class="page-title">@yield('page_title', 'Admin')</div>
                <div class="page-sub">@yield('page_subtitle', 'Manage clinic operations')</div>
            </div>

            <div class="topbar-actions">
                <a class="btn btn-sm btn-light" href="{{ route('home') }}" target="_blank">
                    <i class="fa-solid fa-up-right-from-square me-1"></i> Public Site
                </a>
            </div>
        </header>

        <section class="admin-content container-fluid py-3">
            @include('partials.flash')
            @yield('content')
        </section>
    </main>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- Admin JS -->
<script src="{{ asset('js/admin.js') }}"></script>

@stack('scripts')
</body>
</html>
