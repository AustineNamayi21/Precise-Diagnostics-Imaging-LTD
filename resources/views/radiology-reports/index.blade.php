@extends('layouts.admin')

@section('title', 'Radiology Reports - Patient Management System')

@section('page-title', 'Radiology Reports')

@section('breadcrumbs')
<li class="breadcrumb-item active">Reports</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <form action="{{ route('radiology-reports.index') }}" method="GET" class="me-2 search-box">
        <div class="input-group">
            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search reports..." value="{{ request('search') }}">
            <select class="form-select form-select-sm" name="status">
                <option value="">All Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="finalized" {{ request('status') == 'finalized' ? 'selected' : '' }}>Finalized</option>
                <option value="amended" {{ request('status') == 'amended' ? 'selected' : '' }}>Amended</option>
            </select>
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="fas fa-filter"></i>
            </button>
        </div>
    </form>
    <a href="{{ route('radiology-reports.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> New Report
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
                            <th>Service</th>
                            <th>Radiologist</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Sent</th>
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
                                </a><br>
                                <small class="text-muted">ID: {{ $report->serviceRecord->visit->patient->patient_id }}</small>
                            </td>
                            <td>
                                {{ $report->serviceRecord->service->name }}<br>
                                <small class="text-muted">{{ strtoupper($report->serviceRecord->service->modality) }}</small>
                            </td>
                            <td>{{ $report->radiologist->name ?? 'Unassigned' }}</td>
                            <td>
                                @if($report->priority == 'urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @elseif($report->priority == 'stat')
                                    <span class="badge bg-warning">STAT</span>
                                @else
                                    <span class="badge bg-info">Routine</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge status-{{ $report->status }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td>{{ $report->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($report->sent_to_patient)
                                    <span class="badge bg-success">Yes</span><br>
                                    <small class="text-muted">{{ $report->sent_at->format('M d') }}</small>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('radiology-reports.show', $report) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($report->isEditable())
                                    <a href="{{ route('radiology-reports.edit', $report) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('reports.download', $report) }}" class="btn btn-sm btn-success" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @if($report->status == 'finalized' && !$report->sent_to_patient)
                                    <form action="{{ route('reports.send', $report) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary" title="Send to Patient">
                                            <i class="fas fa-paper-plane"></i>
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
                    Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports
                </div>
                <div>
                    {{ $reports->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-file-medical fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No radiology reports found</h5>
                @if(request('search') || request('status'))
                    <p>No reports match your filter criteria.</p>
                    <a href="{{ route('radiology-reports.index') }}" class="btn btn-outline-primary">Clear Filters</a>
                @else
                    <p>Get started by creating your first radiology report.</p>
                    <a href="{{ route('radiology-reports.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Create First Report
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Statistics -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Reports</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-alt"></i>
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
                        <h6 class="text-muted mb-1">Draft</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('status', 'draft')->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-edit"></i>
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
                        <h6 class="text-muted mb-1">Finalized</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('status', 'finalized')->count() }}</h3>
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
                        <h6 class="text-muted mb-1">Pending Delivery</h6>
                        <h3 class="mb-0">{{ \App\Models\RadiologyReport::where('status', 'finalized')->where('sent_to_patient', false)->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fee2e2; color: #991b1b; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection