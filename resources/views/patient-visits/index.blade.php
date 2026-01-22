@extends('layouts.admin')

@section('title', 'Patient Visits - Patient Management System')

@section('page-title', 'Patient Visits')

@section('breadcrumbs')
<li class="breadcrumb-item active">Visits</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <form action="{{ route('patient-visits.index') }}" method="GET" class="me-2 search-box">
        <div class="input-group">
            <input type="date" class="form-control form-control-sm" name="date" value="{{ request('date') }}">
            <select class="form-select form-select-sm" name="status">
                <option value="">All Status</option>
                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="fas fa-filter"></i>
            </button>
        </div>
    </form>
    <a href="{{ route('patient-visits.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> New Visit
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-body">
        @if($visits->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Patient</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Radiographer</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                        <tr>
                            <td>
                                <strong>{{ $visit->visit_date->format('M d, Y') }}</strong><br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none">
                                    {{ $visit->patient->full_name }}
                                </a><br>
                                <small class="text-muted">ID: {{ $visit->patient->patient_id }}</small>
                            </td>
                            <td>{{ ucfirst($visit->visit_type) }}</td>
                            <td>{{ Str::limit($visit->reason_for_visit, 30) }}</td>
                            <td>{{ $visit->radiographer->name ?? 'N/A' }}</td>
                            <td>
                                <span class="status-badge status-{{ $visit->status }}">
                                    {{ ucfirst($visit->status) }}
                                </span>
                            </td>
                            <td>₹{{ number_format($visit->total_amount, 2) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('patient-visits.show', $visit) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('patient-visits.edit', $visit) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('patient-visits.destroy', $visit) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, 'Are you sure you want to delete this visit?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                    Showing {{ $visits->firstItem() }} to {{ $visits->lastItem() }} of {{ $visits->total() }} visits
                </div>
                <div>
                    {{ $visits->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No visits found</h5>
                @if(request('date') || request('status'))
                    <p>No visits match your filter criteria.</p>
                    <a href="{{ route('patient-visits.index') }}" class="btn btn-outline-primary">Clear Filters</a>
                @else
                    <p>Get started by scheduling your first patient visit.</p>
                    <a href="{{ route('patient-visits.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Schedule Visit
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Today's Visits Summary -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Today's Visits</h6>
                        <h3 class="mb-0">{{ \App\Models\PatientVisit::today()->count() }}</h3>
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
                        <h6 class="text-muted mb-1">Scheduled</h6>
                        <h3 class="mb-0">{{ \App\Models\PatientVisit::where('status', 'scheduled')->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock"></i>
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
                        <h6 class="text-muted mb-1">In Progress</h6>
                        <h3 class="mb-0">{{ \App\Models\PatientVisit::where('status', 'in_progress')->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-procedures"></i>
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
                        <h6 class="text-muted mb-1">Completed</h6>
                        <h3 class="mb-0">{{ \App\Models\PatientVisit::where('status', 'completed')->count() }}</h3>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection