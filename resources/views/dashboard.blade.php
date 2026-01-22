@extends('layouts.admin')

@section('title', 'Dashboard - Patient Management System')

@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-3 mb-4">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Patients</h6>
                        <h3 class="mb-0">{{ $stats['total_patients'] }}</h3>
                    </div>
                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-arrow-up me-1"></i> {{ $stats['active_patients'] }} active
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Today's Visits</h6>
                        <h3 class="mb-0">{{ $stats['today_visits'] }}</h3>
                    </div>
                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-info">
                        <i class="fas fa-clock me-1"></i> {{ $stats['upcoming_visits'] }} upcoming
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pending Reports</h6>
                        <h3 class="mb-0">{{ $stats['pending_reports'] }}</h3>
                    </div>
                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-warning">
                        <i class="fas fa-exclamation-circle me-1"></i> Needs attention
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Reports to Send</h6>
                        <h3 class="mb-0">{{ $stats['reports_to_send'] }}</h3>
                    </div>
                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #fee2e2; color: #991b1b; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-check-circle me-1"></i> {{ $stats['recent_reports'] }} recent
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Visits -->
    <div class="col-md-6 mb-4">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-history me-2"></i> Recent Patient Visits</h6>
                <a href="{{ route('patient-visits.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="admin-card-body">
                @if($recentVisits->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentVisits as $visit)
                                <tr>
                                    <td>
                                        <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none">
                                            {{ $visit->patient->full_name }}
                                        </a>
                                    </td>
                                    <td>{{ $visit->visit_date->format('M d, Y') }}</td>
                                    <td>{{ ucfirst($visit->visit_type) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $visit->status }}">
                                            {{ ucfirst($visit->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No recent visits found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Today's Appointments -->
    <div class="col-md-6 mb-4">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Today's Appointments</h6>
                <a href="{{ route('patient-visits.create') }}" class="btn btn-sm btn-primary">Add New</a>
            </div>
            <div class="admin-card-body">
                @if($todaysAppointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Service</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todaysAppointments as $visit)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none">
                                            {{ $visit->patient->full_name }}
                                        </a>
                                    </td>
                                    <td>{{ ucfirst($visit->visit_type) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $visit->status }}">
                                            {{ ucfirst($visit->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-check fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No appointments scheduled for today.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pending Reports -->
    <div class="col-md-8 mb-4">
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-file-medical me-2"></i> Pending Radiology Reports</h6>
                <a href="{{ route('radiology-reports.create') }}" class="btn btn-sm btn-primary">Create Report</a>
            </div>
            <div class="admin-card-body">
                @if($pendingReports->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Report #</th>
                                    <th>Patient</th>
                                    <th>Service</th>
                                    <th>Radiologist</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingReports as $report)
                                <tr>
                                    <td><strong>{{ $report->report_number }}</strong></td>
                                    <td>
                                        <a href="{{ route('patients.show', $report->serviceRecord->visit->patient) }}" class="text-decoration-none">
                                            {{ $report->serviceRecord->visit->patient->full_name }}
                                        </a>
                                    </td>
                                    <td>{{ $report->serviceRecord->service->name ?? 'N/A' }}</td>
                                    <td>{{ $report->radiologist->name ?? 'Unassigned' }}</td>
                                    <td>{{ $report->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('radiology-reports.edit', $report) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('radiology-reports.show', $report) }}" class="btn btn-sm btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                        <p class="text-muted">No pending reports. All caught up!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Modality Statistics -->
    <div class="col-md-4 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i> Services by Modality (Last 30 Days)</h6>
            </div>
            <div class="admin-card-body">
                @if($modalityStats->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($modalityStats as $stat)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <i class="fas 
                                    @if($stat->modality == 'xray') fa-radiation
                                    @elseif($stat->modality == 'ct') fa-brain
                                    @elseif($stat->modality == 'mri') fa-magnet
                                    @elseif($stat->modality == 'ultrasound') fa-wave-square
                                    @elseif($stat->modality == 'mammography') fa-female
                                    @elseif($stat->modality == 'fluoroscopy') fa-video
                                    @endif 
                                    me-2 text-primary"></i>
                                <span class="text-uppercase">{{ $stat->modality }}</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $stat->count }}</span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-bar fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No service data available.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
            </div>
            <div class="admin-card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i> New Patient
                    </a>
                    <a href="{{ route('patient-visits.create') }}" class="btn btn-success">
                        <i class="fas fa-calendar-plus me-2"></i> Schedule Visit
                    </a>
                    <a href="{{ route('radiology-reports.create') }}" class="btn btn-warning">
                        <i class="fas fa-file-medical me-2"></i> Create Report
                    </a>
                    <a href="{{ route('report-delivery.history') }}" class="btn btn-info">
                        <i class="fas fa-paper-plane me-2"></i> Send Reports
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Status -->
<div class="row">
    <div class="col-md-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-server me-2"></i> System Status</h6>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="mb-2">
                            <i class="fas fa-database fa-2x text-primary"></i>
                        </div>
                        <h5>{{ \App\Models\Patient::count() + \App\Models\PatientVisit::count() + \App\Models\RadiologyReport::count() }}</h5>
                        <p class="text-muted mb-0">Total Records</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="mb-2">
                            <i class="fas fa-user-md fa-2x text-success"></i>
                        </div>
                        <h5>{{ \App\Models\User::whereIn('role', ['radiologist', 'radiographer'])->count() }}</h5>
                        <p class="text-muted mb-0">Active Staff</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="mb-2">
                            <i class="fas fa-rupee-sign fa-2x text-warning"></i>
                        </div>
                        <h5>₹{{ number_format(\App\Models\PatientVisit::sum('total_amount'), 2) }}</h5>
                        <p class="text-muted mb-0">Total Revenue</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="mb-2">
                            <i class="fas fa-check-circle fa-2x text-info"></i>
                        </div>
                        <h5>{{ \App\Models\RadiologyReport::where('sent_to_patient', true)->count() }}</h5>
                        <p class="text-muted mb-0">Reports Delivered</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-refresh dashboard every 5 minutes
    setInterval(function() {
        window.location.reload();
    }, 300000); // 5 minutes
    
    // Update time display
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString();
    }
    
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
</script>
@endpush