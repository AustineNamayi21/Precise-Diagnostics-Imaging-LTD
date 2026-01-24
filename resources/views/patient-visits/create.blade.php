@extends('layouts.app')

@section('title', 'Schedule New Visit - Patient Management System')

@section('page-title', 'Schedule New Visit')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patient-visits.index') }}">Visits</a></li>
<li class="breadcrumb-item active">Schedule New</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-calendar-plus me-2"></i> Schedule Patient Visit</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('patient-visits.store') }}" method="POST">
                    @csrf
                    
                    <!-- Patient Selection -->
                    <div class="mb-4">
                        <label for="patient_id" class="form-label">Select Patient *</label>
                        <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                            <option value="">Select a patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id', request('patient_id')) == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->full_name }} (ID: {{ $patient->patient_id }}) - {{ $patient->phone }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Can't find the patient? <a href="{{ route('patients.create') }}">Create new patient</a></small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="visit_date" class="form-label">Visit Date *</label>
                            <input type="date" class="form-control @error('visit_date') is-invalid @enderror" 
                                   id="visit_date" name="visit_date" value="{{ old('visit_date', date('Y-m-d')) }}" required>
                            @error('visit_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="visit_time" class="form-label">Visit Time *</label>
                            <input type="time" class="form-control @error('visit_time') is-invalid @enderror" 
                                   id="visit_time" name="visit_time" value="{{ old('visit_time', '09:00') }}" required>
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
                                <option value="consultation" {{ old('visit_type') == 'consultation' ? 'selected' : '' }}>Consultation</option>
                                <option value="imaging" {{ old('visit_type') == 'imaging' ? 'selected' : '' }}>Imaging</option>
                                <option value="follow_up" {{ old('visit_type') == 'follow_up' ? 'selected' : '' }}>Follow-up</option>
                                <option value="emergency" {{ old('visit_type') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                            </select>
                            @error('visit_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partial" {{ old('payment_status') == 'partial' ? 'selected' : '' }}>Partial Payment</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="reason_for_visit" class="form-label">Reason for Visit *</label>
                        <textarea class="form-control @error('reason_for_visit') is-invalid @enderror" 
                                  id="reason_for_visit" name="reason_for_visit" rows="3" required>{{ old('reason_for_visit') }}</textarea>
                        @error('reason_for_visit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="clinical_notes" class="form-label">Clinical Notes</label>
                        <textarea class="form-control @error('clinical_notes') is-invalid @enderror" 
                                  id="clinical_notes" name="clinical_notes" rows="3">{{ old('clinical_notes') }}</textarea>
                        @error('clinical_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Any preliminary observations or instructions</small>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('patient-visits.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-check me-1"></i> Schedule Visit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-calendar-day me-2"></i> Today's Schedule</h6>
            </div>
            <div class="admin-card-body">
                @php
                    $todaysVisits = \App\Models\PatientVisit::with('patient')
                        ->whereDate('visit_date', today())
                        ->whereIn('status', ['scheduled', 'in_progress'])
                        ->orderBy('visit_time')
                        ->get();
                @endphp
                
                @if($todaysVisits->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($todaysVisits as $visit)
                        <div class="list-group-item px-0 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $visit->patient->full_name }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($visit->visit_time)->format('h:i A') }} • {{ ucfirst($visit->visit_type) }}</small>
                                </div>
                                <span class="badge bg-{{ $visit->status == 'scheduled' ? 'warning' : 'primary' }}">
                                    {{ ucfirst($visit->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-check fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No visits scheduled for today</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i> Quick Tips</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Visit Types</h6>
                    <ul class="mb-0 small ps-3">
                        <li><strong>Consultation:</strong> Initial assessment and diagnosis</li>
                        <li><strong>Imaging:</strong> X-ray, MRI, CT scan, Ultrasound</li>
                        <li><strong>Follow-up:</strong> Review of previous imaging results</li>
                        <li><strong>Emergency:</strong> Urgent care and immediate attention</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-fill tomorrow's date for scheduling convenience
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // Format as YYYY-MM-DD
        const formattedDate = tomorrow.toISOString().split('T')[0];
        
        // Set default date to tomorrow if not already set
        const dateInput = document.getElementById('visit_date');
        if (dateInput && !dateInput.value) {
            dateInput.value = formattedDate;
        }
        
        // Patient search enhancement
        const patientSelect = document.getElementById('patient_id');
        if (patientSelect) {
            // Make select searchable
            new Choices(patientSelect, {
                searchEnabled: true,
                itemSelectText: '',
                shouldSort: false,
            });
        }
    });
</script>
@endpush