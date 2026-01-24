@extends('layouts.app')

@section('title', $patient->full_name . ' - Patient Details')

@section('page-title', 'Patient Details')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patients.index') }}">Patients</a></li>
<li class="breadcrumb-item active">{{ $patient->full_name }}</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning me-2">
        <i class="fas fa-edit me-1"></i> Edit
    </a>
    <a href="{{ route('patient-visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-primary me-2">
        <i class="fas fa-calendar-plus me-1"></i> New Visit
    </a>
    <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirmDelete(event, 'Are you sure you want to delete this patient and all associated records?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash me-1"></i> Delete
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Patient Information Card -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-user me-2"></i> Patient Information</h6>
            </div>
            <div class="admin-card-body">
                <div class="text-center mb-4">
                    <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">
                        {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                    </div>
                    <h4>{{ $patient->full_name }}</h4>
                    <p class="text-muted mb-0">Patient ID: {{ $patient->patient_id }}</p>
                    <span class="status-badge {{ $patient->is_active ? 'status-active' : 'status-inactive' }} mt-2">
                        {{ $patient->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <div class="patient-details">
                    <h6 class="border-bottom pb-2 mb-3">Contact Details</h6>
                    <div class="mb-3">
                        <small class="text-muted d-block">Email</small>
                        <p class="mb-0"><i class="fas fa-envelope me-2 text-primary"></i> {{ $patient->email }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Phone</small>
                        <p class="mb-0"><i class="fas fa-phone me-2 text-primary"></i> {{ $patient->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Address</small>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2 text-primary"></i> 
                            @if($patient->address)
                                {{ $patient->address }}, {{ $patient->city ?? '' }} {{ $patient->state ?? '' }} {{ $patient->postal_code ?? '' }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    
                    <h6 class="border-bottom pb-2 mb-3 mt-4">Medical Information</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Date of Birth</small>
                            <p class="mb-0"><i class="fas fa-birthday-cake me-2 text-primary"></i> {{ $patient->date_of_birth->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted d-block">Age</small>
                            <p class="mb-0"><i class="fas fa-user-clock me-2 text-primary"></i> {{ $patient->age }} years</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Gender</small>
                        <p class="mb-0"><i class="fas fa-venus-mars me-2 text-primary"></i> {{ ucfirst($patient->gender) }}</p>
                    </div>
                    
                    @if($patient->emergency_contact)
                    <div class="mb-3">
                        <small class="text-muted d-block">Emergency Contact</small>
                        <p class="mb-0"><i class="fas fa-phone-alt me-2 text-primary"></i> {{ $patient->emergency_contact }}</p>
                    </div>
                    @endif
                    
                    @if($patient->allergies)
                    <div class="mb-3">
                        <small class="text-muted d-block">Allergies</small>
                        <p class="mb-0"><i class="fas fa-allergies me-2 text-danger"></i> {{ $patient->allergies }}</p>
                    </div>
                    @endif
                    
                    @if($patient->medical_history)
                    <div class="mb-3">
                        <small class="text-muted d-block">Medical History</small>
                        <p class="mb-0">{{ $patient->medical_history }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Patient Visits -->
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Patient Visits</h6>
                <a href="{{ route('patient-visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> New Visit
                </a>
            </div>
            <div class="admin-card-body">
                @if($patient->visits->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Visit Date</th>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patient->visits as $visit)
                                <tr>
                                    <td>
                                        <strong>{{ $visit->visit_date->format('M d, Y') }}</strong><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }}</small>
                                    </td>
                                    <td>{{ ucfirst($visit->visit_type) }}</td>
                                    <td>{{ Str::limit($visit->reason_for_visit, 30) }}</td>
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
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No visits recorded for this patient.</p>
                        <a href="{{ route('patient-visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-primary">
                            <i class="fas fa-calendar-plus me-1"></i> Schedule First Visit
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Statistics Card -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="admin-card stat-card">
                    <div class="admin-card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Visits</h6>
                                <h3 class="mb-0">{{ $patient->visits->count() }}</h3>
                            </div>
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dbeafe; color: #1e40af; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="admin-card stat-card">
                    <div class="admin-card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Completed</h6>
                                <h3 class="mb-0">{{ $patient->visits->where('status', 'completed')->count() }}</h3>
                            </div>
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #dcfce7; color: #166534; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="admin-card stat-card">
                    <div class="admin-card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Amount</h6>
                                <h3 class="mb-0">₹{{ number_format($patient->visits->sum('total_amount'), 2) }}</h3>
                            </div>
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-rupee-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection