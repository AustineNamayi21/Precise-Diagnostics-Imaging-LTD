@extends('layouts.app')

@section('title', 'Dashboard - Patient Management System')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row g-3 g-md-4">
        <!-- Statistics Cards -->
        <div class="col-6 col-sm-3 col-md-3 col-lg-3">
            <div class="admin-card stat-card h-100">
                <div class="admin-card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1 me-2">
                            <h6 class="text-muted mb-1 fw-normal small">Total Patients</h6>
                            <h3 class="mb-0 fw-bold">{{ $stats['total_patients'] ?? 0 }}</h3>
                        </div>
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-2 pt-1 border-top border-light">
                        <small class="text-success d-flex align-items-center">
                            <i class="fas fa-arrow-up me-1 small"></i> 
                            <span class="small">{{ $stats['active_patients'] ?? 0 }} active</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-sm-3 col-md-3 col-lg-3">
            <div class="admin-card stat-card h-100">
                <div class="admin-card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1 me-2">
                            <h6 class="text-muted mb-1 fw-normal small">Today's Visits</h6>
                            <h3 class="mb-0 fw-bold">{{ $stats['today_visits'] ?? 0 }}</h3>
                        </div>
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                    <div class="mt-2 pt-1 border-top border-light">
                        <small class="text-info d-flex align-items-center">
                            <i class="fas fa-clock me-1 small"></i> 
                            <span class="small">{{ $stats['upcoming_visits'] ?? 0 }} upcoming</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-sm-3 col-md-3 col-lg-3">
            <div class="admin-card stat-card h-100">
                <div class="admin-card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1 me-2">
                            <h6 class="text-muted mb-1 fw-normal small">Pending Reports</h6>
                            <h3 class="mb-0 fw-bold">{{ $stats['pending_reports'] ?? 0 }}</h3>
                        </div>
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div class="mt-2 pt-1 border-top border-light">
                        <small class="text-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-1 small"></i> 
                            <span class="small">Needs attention</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-sm-3 col-md-3 col-lg-3">
            <div class="admin-card stat-card h-100">
                <div class="admin-card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1 me-2">
                            <h6 class="text-muted mb-1 fw-normal small">Reports to Send</h6>
                            <h3 class="mb-0 fw-bold">{{ $stats['reports_to_send'] ?? 0 }}</h3>
                        </div>
                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #fee2e2; color: #991b1b; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                    <div class="mt-2 pt-1 border-top border-light">
                        <small class="text-success d-flex align-items-center">
                            <i class="fas fa-check-circle me-1 small"></i> 
                            <span class="small">{{ $stats['recent_reports'] ?? 0 }} recent</span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mt-0">
        <!-- Recent Visits -->
        <div class="col-12 col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-header d-flex justify-content-between align-items-center py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-history me-2 text-primary"></i> Recent Patient Visits</h6>
                    <a href="{{ route('patient-visits.index') }}" class="btn btn-sm btn-outline-primary py-1 px-3 small">View All</a>
                </div>
                <div class="admin-card-body p-3">
                    @if(isset($recentVisits) && $recentVisits->count() > 0)
                        <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-hover table-sm mb-0">
                                <thead>
                                    <tr class="small">
                                        <th class="border-0">Patient</th>
                                        <th class="border-0">Date</th>
                                        <th class="border-0">Type</th>
                                        <th class="border-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentVisits as $visit)
                                    <tr class="small">
                                        <td class="py-2">
                                            <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none text-dark">
                                                {{ $visit->patient->full_name ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td class="py-2 text-muted">{{ $visit->visit_date->format('M d, Y') ?? 'N/A' }}</td>
                                        <td class="py-2"><span class="badge bg-light text-dark">{{ ucfirst($visit->visit_type ?? 'N/A') }}</span></td>
                                        <td class="py-2">
                                            <span class="status-badge status-{{ $visit->status ?? 'unknown' }}">
                                                {{ ucfirst($visit->status ?? 'Unknown') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                            <p class="text-muted small">No recent visits found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Today's Appointments -->
        <div class="col-12 col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-header d-flex justify-content-between align-items-center py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-calendar-check me-2 text-success"></i> Today's Appointments</h6>
                    <a href="{{ route('patient-visits.create') }}" class="btn btn-sm btn-primary py-1 px-3 small">Add New</a>
                </div>
                <div class="admin-card-body p-3">
                    @if(isset($todaysAppointments) && $todaysAppointments->count() > 0)
                        <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-hover table-sm mb-0">
                                <thead>
                                    <tr class="small">
                                        <th class="border-0">Time</th>
                                        <th class="border-0">Patient</th>
                                        <th class="border-0">Service</th>
                                        <th class="border-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todaysAppointments as $visit)
                                    <tr class="small">
                                        <td class="py-2 text-muted">{{ \Carbon\Carbon::parse($visit->visit_time ?? now())->format('h:i A') }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none text-dark">
                                                {{ $visit->patient->full_name ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td class="py-2"><span class="badge bg-light text-dark">{{ ucfirst($visit->visit_type ?? 'N/A') }}</span></td>
                                        <td class="py-2">
                                            <span class="status-badge status-{{ $visit->status ?? 'unknown' }}">
                                                {{ ucfirst($visit->status ?? 'Unknown') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-check fa-2x text-muted mb-3"></i>
                            <p class="text-muted small">No appointments scheduled for today.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mt-0">
        <!-- Pending Reports -->
        <div class="col-12 col-lg-8">
            <div class="admin-card h-100">
                <div class="admin-card-header d-flex justify-content-between align-items-center py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-file-medical me-2 text-warning"></i> Pending Radiology Reports</h6>
                    <a href="{{ route('radiology-reports.create') }}" class="btn btn-sm btn-primary py-1 px-3 small">Create Report</a>
                </div>
                <div class="admin-card-body p-3">
                    @if(isset($pendingReports) && $pendingReports->count() > 0)
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover table-sm mb-0">
                                <thead>
                                    <tr class="small">
                                        <th class="border-0">Report #</th>
                                        <th class="border-0">Patient</th>
                                        <th class="border-0">Service</th>
                                        <th class="border-0">Radiologist</th>
                                        <th class="border-0">Created</th>
                                        <th class="border-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingReports as $report)
                                    <tr class="small">
                                        <td class="py-2"><strong class="text-dark">{{ $report->report_number ?? 'N/A' }}</strong></td>
                                        <td class="py-2">
                                            @if(isset($report->serviceRecord->visit->patient))
                                                <a href="{{ route('patients.show', $report->serviceRecord->visit->patient) }}" class="text-decoration-none text-dark">
                                                    {{ $report->serviceRecord->visit->patient->full_name ?? 'N/A' }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td class="py-2"><span class="badge bg-light text-dark">{{ $report->serviceRecord->service->name ?? 'N/A' }}</span></td>
                                        <td class="py-2 text-muted">{{ $report->radiologist->name ?? 'Unassigned' }}</td>
                                        <td class="py-2 text-muted">{{ $report->created_at->format('M d, Y') ?? 'N/A' }}</td>
                                        <td class="py-2">
                                            <div class="action-buttons d-flex gap-1">
                                                <a href="{{ route('radiology-reports.edit', $report) }}" class="btn btn-sm btn-outline-warning py-0 px-2" title="Edit">
                                                    <i class="fas fa-edit small"></i>
                                                </a>
                                                <a href="{{ route('radiology-reports.show', $report) }}" class="btn btn-sm btn-outline-info py-0 px-2" title="View">
                                                    <i class="fas fa-eye small"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <h6 class="text-muted">No pending reports. All caught up!</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Modality Statistics & Quick Actions -->
        <div class="col-12 col-lg-4">
            <div class="admin-card h-100">
                <div class="admin-card-header py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-chart-pie me-2 text-info"></i> Services by Modality (Last 30 Days)</h6>
                </div>
                <div class="admin-card-body p-3">
                    @if(isset($modalityStats) && $modalityStats->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($modalityStats as $stat)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0 border-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas 
                                        @if($stat->modality == 'xray') fa-radiation
                                        @elseif($stat->modality == 'ct') fa-brain
                                        @elseif($stat->modality == 'mri') fa-magnet
                                        @elseif($stat->modality == 'ultrasound') fa-wave-square
                                        @elseif($stat->modality == 'mammography') fa-female
                                        @elseif($stat->modality == 'fluoroscopy') fa-video
                                        @else fa-x-ray
                                        @endif 
                                        me-2 text-primary" style="width: 20px;"></i>
                                    <span class="text-capitalize small">{{ $stat->modality ?? 'Unknown' }}</span>
                                </div>
                                <span class="badge bg-primary rounded-pill px-2 py-1">{{ $stat->count ?? 0 }}</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-bar fa-2x text-muted mb-3"></i>
                            <p class="text-muted small">No service data available.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="admin-card mt-3 mt-lg-4 h-auto">
                <div class="admin-card-header py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-bolt me-2 text-success"></i> Quick Actions</h6>
                </div>
                <div class="admin-card-body p-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm py-2">
                            <i class="fas fa-user-plus me-2"></i> New Patient
                        </a>
                        <a href="{{ route('patient-visits.create') }}" class="btn btn-success btn-sm py-2">
                            <i class="fas fa-calendar-plus me-2"></i> Schedule Visit
                        </a>
                        <a href="{{ route('radiology-reports.create') }}" class="btn btn-warning btn-sm py-2">
                            <i class="fas fa-file-medical me-2"></i> Create Report
                        </a>
                        <a href="{{ route('report-delivery.history') }}" class="btn btn-info btn-sm py-2">
                            <i class="fas fa-paper-plane me-2"></i> Send Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="row g-3 g-md-4 mt-0">
        <div class="col-12">
            <div class="admin-card">
                <div class="admin-card-header py-3 px-3">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-server me-2 text-secondary"></i> System Status</h6>
                </div>
                <div class="admin-card-body p-3">
                    <div class="row g-3">
                        <div class="col-6 col-sm-3 text-center">
                            <div class="mb-2">
                                <i class="fas fa-database fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">{{ \App\Models\Patient::count() + \App\Models\PatientVisit::count() + \App\Models\RadiologyReport::count() }}</h5>
                            <p class="text-muted mb-0 small">Total Records</p>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <div class="mb-2">
                                <i class="fas fa-user-md fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold">{{ \App\Models\User::whereIn('role', ['radiologist', 'radiographer'])->count() }}</h5>
                            <p class="text-muted mb-0 small">Active Staff</p>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <div class="mb-2">
                                <i class="fas fa-rupee-sign fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">₹{{ number_format(\App\Models\PatientVisit::sum('total_amount'), 2) }}</h5>
                            <p class="text-muted mb-0 small">Total Revenue</p>
                        </div>
                        <div class="col-6 col-sm-3 text-center">
                            <div class="mb-2">
                                <i class="fas fa-check-circle fa-2x text-info"></i>
                            </div>
                            <h5 class="fw-bold">{{ \App\Models\RadiologyReport::where('sent_to_patient', true)->count() }}</h5>
                            <p class="text-muted mb-0 small">Reports Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-card {
            margin-bottom: 1rem;
        }
        .admin-card-body {
            padding: 1rem !important;
        }
        .stat-card h3 {
            font-size: 1.5rem;
        }
        .admin-card-header {
            padding: 0.75rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .col-6 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        .admin-card-body {
            padding: 0.75rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-refresh dashboard every 5 minutes
    setInterval(function() {
        window.location.reload();
    }, 300000); // 5 minutes
    
    // Update time display
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
    
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
</script>
@endpush