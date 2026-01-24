@extends('layouts.app')

@section('title', 'Visit Details - ' . $patientVisit->patient->full_name)

@section('page-title', 'Visit Details')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patient-visits.index') }}">Visits</a></li>
<li class="breadcrumb-item active">Details</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <a href="{{ route('patient-visits.edit', $patientVisit) }}" class="btn btn-warning me-2">
        <i class="fas fa-edit me-1"></i> Edit
    </a>
    <a href="{{ route('reports.create.for-service', $patientVisit->serviceRecords->first() ?? 0) }}" class="btn btn-primary me-2">
        <i class="fas fa-file-medical me-1"></i> Create Report
    </a>
    <form action="{{ route('patient-visits.destroy', $patientVisit) }}" method="POST" onsubmit="return confirmDelete(event, 'Are you sure you want to delete this visit?')">
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
        <!-- Visit Information -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Visit Information</h6>
            </div>
            <div class="admin-card-body">
                <div class="mb-4">
                    <h5 class="text-center">{{ $patientVisit->patient->full_name }}</h5>
                    <p class="text-center text-muted mb-0">Visit ID: {{ $patientVisit->id }}</p>
                </div>
                
                <div class="visit-details">
                    <div class="mb-3">
                        <small class="text-muted d-block">Date & Time</small>
                        <p class="mb-0">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            {{ $patientVisit->visit_date->format('F d, Y') }} at 
                            {{ \Carbon\Carbon::parse($patientVisit->visit_time)->format('h:i A') }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Visit Type</small>
                        <p class="mb-0">
                            <i class="fas fa-stethoscope me-2 text-primary"></i>
                            {{ ucfirst($patientVisit->visit_type) }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Status</small>
                        <p class="mb-0">
                            <span class="status-badge status-{{ $patientVisit->status }}">
                                {{ ucfirst($patientVisit->status) }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Payment Status</small>
                        <p class="mb-0">
                            @if($patientVisit->payment_status == 'paid')
                                <i class="fas fa-check-circle me-2 text-success"></i>
                            @elseif($patientVisit->payment_status == 'partial')
                                <i class="fas fa-exclamation-circle me-2 text-warning"></i>
                            @else
                                <i class="fas fa-clock me-2 text-danger"></i>
                            @endif
                            {{ ucfirst($patientVisit->payment_status) }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Total Amount</small>
                        <h5 class="mb-0">₹{{ number_format($patientVisit->total_amount, 2) }}</h5>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Radiographer</small>
                        <p class="mb-0">
                            <i class="fas fa-user-md me-2 text-primary"></i>
                            {{ $patientVisit->radiographer->name ?? 'Not Assigned' }}
                        </p>
                    </div>
                </div>
                
                <hr>
                
                <div class="mb-3">
                    <small class="text-muted d-block">Reason for Visit</small>
                    <p class="mb-0">{{ $patientVisit->reason_for_visit }}</p>
                </div>
                
                @if($patientVisit->clinical_notes)
                <div class="mb-3">
                    <small class="text-muted d-block">Clinical Notes</small>
                    <p class="mb-0">{{ $patientVisit->clinical_notes }}</p>
                </div>
                @endif
                
                <div class="mt-4">
                    <a href="{{ route('patients.show', $patientVisit->patient) }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-user me-2"></i> View Patient Profile
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
            </div>
            <div class="admin-card-body">
                <div class="d-grid gap-2">
                    @if($patientVisit->status != 'completed')
                    <form action="{{ route('service-records.update-status', $patientVisit->serviceRecords->first()->id ?? 0) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-check-circle me-2"></i> Mark as Completed
                        </button>
                    </form>
                    @endif
                    
                    <a href="{{ route('visits.add-service', $patientVisit) }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-plus-circle me-2"></i> Add Service
                    </a>
                    
                    <a href="#" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-print me-2"></i> Print Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Services Performed -->
        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-procedures me-2"></i> Services Performed</h6>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="fas fa-plus me-1"></i> Add Service
                </button>
            </div>
            <div class="admin-card-body">
                @if($patientVisit->serviceRecords->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Modality</th>
                                    <th>Date</th>
                                    <th>Radiologist</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Report</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patientVisit->serviceRecords as $record)
                                <tr>
                                    <td>
                                        <strong>{{ $record->service->name }}</strong><br>
                                        <small class="text-muted">{{ $record->service->service_code }}</small>
                                    </td>
                                    <td>{{ strtoupper($record->service->modality) }}</td>
                                    <td>{{ $record->service_date->format('M d, Y') }}</td>
                                    <td>{{ $record->radiologist->name ?? 'Not Assigned' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $record->status }}">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td>₹{{ number_format($record->service->price, 2) }}</td>
                                    <td>
                                        @if($record->report)
                                            <span class="badge bg-success">Report Generated</span>
                                        @else
                                            <span class="badge bg-warning">No Report</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            @if(!$record->report)
                                            <a href="{{ route('reports.create.for-service', $record) }}" class="btn btn-sm btn-primary" title="Create Report">
                                                <i class="fas fa-file-medical"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('radiology-reports.show', $record->report) }}" class="btn btn-sm btn-info" title="View Report">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @endif
                                            <form action="{{ route('visits.remove-service', $record) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, 'Remove this service?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Remove">
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
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-procedures fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No services have been added to this visit.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="fas fa-plus me-1"></i> Add First Service
                        </button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Reports Summary -->
        @if($patientVisit->reports->count() > 0)
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-file-medical me-2"></i> Generated Reports</h6>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Report #</th>
                                <th>Service</th>
                                <th>Radiologist</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patientVisit->reports as $report)
                            <tr>
                                <td><strong>{{ $report->report_number }}</strong></td>
                                <td>{{ $report->serviceRecord->service->name }}</td>
                                <td>{{ $report->radiologist->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ $report->status }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>
                                <td>{{ $report->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('radiology-reports.show', $report) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('reports.download', $report) }}" class="btn btn-sm btn-success" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        @if($report->status == 'finalized' && !$report->sent_to_patient)
                                        <form action="{{ route('reports.send', $report) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Send to Patient">
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
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Imaging Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('visits.add-service', $patientVisit) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="imaging_service_id" class="form-label">Select Service *</label>
                        <select class="form-select" id="imaging_service_id" name="imaging_service_id" required>
                            <option value="">Choose a service</option>
                            @foreach($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }} ({{ $service->service_code }}) - ₹{{ number_format($service->price, 2) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="service_date" class="form-label">Service Date *</label>
                        <input type="date" class="form-control" id="service_date" name="service_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="radiologist_id" class="form-label">Assign Radiologist</label>
                        <select class="form-select" id="radiologist_id" name="radiologist_id">
                            <option value="">Select Radiologist</option>
                            @foreach(\App\Models\User::where('role', 'radiologist')->get() as $radiologist)
                            <option value="{{ $radiologist->id }}">{{ $radiologist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="technician_notes" class="form-label">Technician Notes</label>
                        <textarea class="form-control" id="technician_notes" name="technician_notes" rows="3" placeholder="Any specific instructions or observations..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection