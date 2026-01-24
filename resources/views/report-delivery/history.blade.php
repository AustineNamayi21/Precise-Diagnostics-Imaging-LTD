@extends('layouts.app')

@section('title', 'Report Delivery History - Patient Management System')

@section('page-title', 'Report Delivery History')

@section('breadcrumbs')
<li class="breadcrumb-item active">Delivery History</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <a href="{{ route('radiology-reports.index') }}?status=finalized&sent_to_patient=false" class="btn btn-primary">
        <i class="fas fa-paper-plane me-1"></i> Send Pending Reports
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-body">
        @if($reports->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Report #</th>
                            <th>Patient</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Sent Date</th>
                            <th>Delivery Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>
                                <strong>{{ $report->report_number }}</strong>
                            </td>
                            <td>
                                <a href="{{ route('patients.show', $report->serviceRecord->visit->patient) }}" class="text-decoration-none">
                                    {{ $report->serviceRecord->visit->patient->full_name }}
                                </a>
                            </td>
                            <td>{{ $report->serviceRecord->visit->patient->email }}</td>
                            <td>{{ $report->serviceRecord->service->name }}</td>
                            <td>
                                {{ $report->sent_at->format('M d, Y h:i A') }}<br>
                                <small class="text-muted">{{ $report->sent_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Email</span>
                            </td>
                            <td>
                                @if($report->sent_to_patient)
                                    <span class="status-badge status-active">Delivered</span>
                                @else
                                    <span class="status-badge status-inactive">Failed</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('radiology-reports.show', $report) }}" class="btn btn-sm btn-info" title="View Report">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('reports.download', $report) }}" class="btn btn-sm btn-success" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @if(!$report->sent_to_patient)
                                    <form action="{{ route('reports.send', $report) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Resend">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} deliveries
                </div>
                <div>
                    {{ $reports->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-paper-plane fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No report delivery history found</h5>
                <p>Reports that have been sent to patients will appear here.</p>
                <a href="{{ route('radiology-reports.index') }}" class="btn btn-primary">
                    <i class="fas fa-file-medical me-1"></i> View Reports
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delivery Statistics -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Delivered</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('sent_to_patient', true)->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Today's Deliveries</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('sent_to_patient', true)->whereDate('sent_at', today())->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">This Month</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('sent_to_patient', true)->whereMonth('sent_at', now()->month)->whereYear('sent_at', now()->year)->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pending Delivery</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('status', 'finalized')->where('sent_to_patient', false)->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fee2e2; color: #991b1b; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection