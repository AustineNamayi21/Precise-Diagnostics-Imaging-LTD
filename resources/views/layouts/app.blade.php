<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Precise Diagnostics</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --admin-sidebar: #1e293b;
            --admin-primary: #3b82f6;
            --admin-secondary: #64748b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .font-heading {
            font-family: 'Poppins', sans-serif;
        }
        
        .admin-sidebar {
            background-color: var(--admin-sidebar);
            min-height: 100vh;
            color: white;
            position: fixed;
            width: 250px;
            z-index: 1000;
        }
        
        .admin-sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            margin: 2px 0;
        }
        
        .admin-sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--admin-primary);
        }
        
        .admin-sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--admin-primary);
        }
        
        .admin-sidebar .logo {
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        
        .admin-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .admin-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            background: white;
        }
        
        .admin-card-header {
            background-color: white;
            border-bottom: 2px solid #f1f5f9;
            font-weight: 600;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
        }
        
        .admin-card-body {
            padding: 20px;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-active { background-color: #dcfce7; color: #166534; }
        .status-inactive { background-color: #fee2e2; color: #991b1b; }
        .status-scheduled { background-color: #dbeafe; color: #1e40af; }
        .status-completed { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-draft { background-color: #fef3c7; color: #92400e; }
        .status-finalized { background-color: #dcfce7; color: #166534; }
        
        .action-buttons .btn {
            margin-right: 5px;
        }
        
        .stat-card {
            border-left: 4px solid var(--admin-primary);
            background: white;
        }
        
        .search-box {
            max-width: 300px;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: static;
                min-height: auto;
            }
            
            .admin-content {
                margin-left: 0;
            }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="admin-sidebar d-none d-md-block">
                <div class="logo">
                    <h4 class="mb-0 font-heading"><i class="fas fa-clinic-medical"></i> Precise Diagnostics</h4>
                    <small class="text-gray-400">Patient Management System</small>
                </div>
                
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
                            <i class="fas fa-users me-2"></i> Patients
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('patient-visits.*') ? 'active' : '' }}" href="{{ route('patient-visits.index') }}">
                            <i class="fas fa-calendar-check me-2"></i> Patient Visits
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('imaging-services.*') ? 'active' : '' }}" href="{{ route('imaging-services.index') }}">
                            <i class="fas fa-x-ray me-2"></i> Imaging Services
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('radiology-reports.*') ? 'active' : '' }}" href="{{ route('radiology-reports.index') }}">
                            <i class="fas fa-file-medical me-2"></i> Radiology Reports
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('report-delivery.*') ? 'active' : '' }}" href="{{ route('report-delivery.history') }}">
                            <i class="fas fa-paper-plane me-2"></i> Report Delivery
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-globe me-2"></i> Visit Website
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
            
            <!-- Main Content -->
            <main class="admin-content">
                <!-- Top Navigation -->
                <nav class="admin-navbar mb-4">
                    <div class="container-fluid">
                        <button class="btn btn-outline-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="d-flex align-items-center">
                            <span class="me-3 d-none d-md-block">
                                <i class="fas fa-user-md me-1"></i> Welcome, {{ auth()->user()->name ?? 'User' }}
                            </span>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Mobile Sidebar (Offcanvas) -->
                <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileSidebar">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title font-heading">Precise Diagnostics</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
                                    <i class="fas fa-users me-2"></i> Patients
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('patient-visits.*') ? 'active' : '' }}" href="{{ route('patient-visits.index') }}">
                                    <i class="fas fa-calendar-check me-2"></i> Patient Visits
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('imaging-services.*') ? 'active' : '' }}" href="{{ route('imaging-services.index') }}">
                                    <i class="fas fa-x-ray me-2"></i> Imaging Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('radiology-reports.*') ? 'active' : '' }}" href="{{ route('radiology-reports.index') }}">
                                    <i class="fas fa-file-medical me-2"></i> Radiology Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('report-delivery.*') ? 'active' : '' }}" href="{{ route('report-delivery.history') }}">
                                    <i class="fas fa-paper-plane me-2"></i> Report Delivery
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Page Title and Actions -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-0 font-heading">@yield('page-title', 'Dashboard')</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                @yield('breadcrumbs')
                            </ol>
                        </nav>
                    </div>
                    <div>
                        @yield('header-actions')
                    </div>
                </div>
                
                <!-- Main Content -->
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Required Scripts -->
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('.data-table').DataTable({
                pageLength: 25,
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Confirm before deleting
            window.confirmDelete = function(event, message = 'Are you sure you want to delete this item?') {
                if (!confirm(message)) {
                    event.preventDefault();
                    return false;
                }
                return true;
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>