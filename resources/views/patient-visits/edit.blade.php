@extends('layouts.admin')

@section('title', 'Edit Visit - ' . $patientVisit->patient->full_name)

@section('page-title', 'Edit Visit')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patient-visits.index') }}">Visits</a></li>
<li class="breadcrumb-item"><a href="{{ route('patient-visits.show', $patientVisit) }}">Details</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Visit Details</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('patient-visits.update', $patientVisit) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label">Patient</label>
                        <div class="form-control bg-light">
                            <strong>{{ $patientVisit->patient->full_name }}</strong><br>
                            <small class="text-muted">ID: {{ $patientVisit->patient->patient_id }} | Phone: {{ $patientVisit->patient->phone }}</small>
                        </div>
                        <small class="text-muted">Patient cannot be changed. Create a new visit for a different patient.</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visit_date" class="form-label">Visit Date *</label>
                            <input type="date" class="form-control @error('visit_date') is-invalid @enderror" 
                                   id="visit_date" name="visit_date" value="{{ old('visit_date', $patientVisit->visit_date->format('Y-m-d')) }}" required>
                            @error('visit_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="visit_time" class="form-label">Visit Time *</label>
                            <input type="time" class="form-control @error('visit_time') is-invalid @enderror" 
                                   id="visit_time" name="visit_time" value="{{ old('visit_time', $patientVisit->visit_time) }}" required>
                            @error('visit_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visit_type" class="form-label">Visit Type *</label>
                            <select class="form-select @error('visit_type') is-invalid @enderror" id="visit_type" name="visit_type" required>
                                <option value="">Select type</option>
                                <option value="consultation" {{ old('visit_type', $patientVisit->visit_type) == 'consultation' ? 'selected' : '' }}>Consultation</option>
                                <option value="imaging" {{ old('visit_type', $patientVisit->visit_type) == 'imaging' ? 'selected' : '' }}>Imaging</option>
                                <option value="follow_up" {{ old('visit_type', $patientVisit->visit_type) == 'follow_up' ? 'selected' : '' }}>Follow-up</option>
                                <option value="emergency" {{ old('visit_type', $patientVisit->visit_type) == 'emergency' ? 'selected' : '' }}>Emergency</option>
                            </select>
                            @error('visit_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="scheduled" {{ old('status', $patientVisit->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="in_progress" {{ old('status', $patientVisit->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $patientVisit->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $patientVisit->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payment_status" class="form-label">Payment Status *</label>
                            <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                <option value="pending" {{ old('payment_status', $patientVisit->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('payment_status', $patientVisit->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partial" {{ old('payment_status', $patientVisit->payment_status) == 'partial' ? 'selected' : '' }}>Partial Payment</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="total_amount" class="form-label">Total Amount (₹)</label>
                            <input type="number" step="0.01" class="form-control @error('total_amount') is-invalid @enderror" 
                                   id="total_amount" name="total_amount" value="{{ old('total_amount', $patientVisit->total_amount) }}">
                            @error('total_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Auto-calculated from services. Manual override if needed.</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="reason_for_visit" class="form-label">Reason for Visit *</label>
                        <textarea class="form-control @error('reason_for_visit') is-invalid @enderror" 
                                  id="reason_for_visit" name="reason_for_visit" rows="3" required>{{ old('reason_for_visit', $patientVisit->reason_for_visit) }}</textarea>
                        @error('reason_for_visit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="clinical_notes" class="form-label">Clinical Notes</label>
                        <textarea class="form-control @error('clinical_notes') is-invalid @enderror" 
                                  id="clinical_notes" name="clinical_notes" rows="3">{{ old('clinical_notes', $patientVisit->clinical_notes) }}</textarea>
                        @error('clinical_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('patient-visits.show', $patientVisit) }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Visit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Visit Summary -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Visit Summary</h6>
            </div>
            <div class="admin-card-body">
                <div class="mb-4 text-center">
                    <div class="avatar mx-auto mb-3" style="width: 60px; height: 60px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: bold;">
                        {{ substr($patientVisit->patient->first_name, 0, 1) }}{{ substr($patientVisit->patient->last_name, 0, 1) }}
                    </div>
                    <h5>{{ $patientVisit->patient->full_name }}</h5>
                    <p class="text-muted mb-0">Visit ID: {{ $patientVisit->id }}</p>
                </div>
                
                <div class="mb-4">
                    <h6><i class="fas fa-list-check me-2"></i> Services Summary</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Total Services
                            <span class="badge bg-primary rounded-pill">{{ $patientVisit->serviceRecords->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Reports Generated
                            <span class="badge bg-success rounded-pill">{{ $patientVisit->reports->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Pending Reports
                            <span class="badge bg-warning rounded-pill">{{ $patientVisit->serviceRecords->where('status', 'completed')->whereDoesntHave('report')->count() }}</span>
                        </li>
                    </ul>
                </div>
                
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-circle me-2"></i> Note</h6>
                    <p class="mb-0 small">Updating visit status to "Completed" will allow report generation for all services.</p>
                </div>
                
                <!-- Quick Update Status -->
                <div class="mt-4">
                    <h6><i class="fas fa-sync-alt me-2"></i> Quick Status Update</h6>
                    <div class="d-grid gap-2">
                        @if($patientVisit->status != 'completed')
                        <form action="{{ route('patient-visits.update', $patientVisit) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <input type="hidden" name="visit_date" value="{{ $patientVisit->visit_date->format('Y-m-d') }}">
                            <input type="hidden" name="visit_time" value="{{ $patientVisit->visit_time }}">
                            <input type="hidden" name="visit_type" value="{{ $patientVisit->visit_type }}">
                            <input type="hidden" name="reason_for_visit" value="{{ $patientVisit->reason_for_visit }}">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check-circle me-2"></i> Mark as Completed
                            </button>
                        </form>
                        @endif
                        
                        @if($patientVisit->status != 'cancelled')
                        <form action="{{ route('patient-visits.update', $patientVisit) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancelled">
                            <input type="hidden" name="visit_date" value="{{ $patientVisit->visit_date->format('Y-m-d') }}">
                            <input type="hidden" name="visit_time" value="{{ $patientVisit->visit_time }}">
                            <input type="hidden" name="visit_type" value="{{ $patientVisit->visit_type }}">
                            <input type="hidden" name="reason_for_visit" value="{{ $patientVisit->reason_for_visit }}">
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to cancel this visit?')">
                                <i class="fas fa-times-circle me-2"></i> Cancel Visit
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection