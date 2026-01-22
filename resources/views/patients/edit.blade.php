@extends('layouts.admin')

@section('title', 'Edit Patient - ' . $patient->full_name)

@section('page-title', 'Edit Patient')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patients.index') }}">Patients</a></li>
<li class="breadcrumb-item"><a href="{{ route('patients.show', $patient) }}">{{ $patient->full_name }}</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Patient Information</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" name="first_name" value="{{ old('first_name', $patient->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" name="last_name" value="{{ old('last_name', $patient->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $patient->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $patient->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth *</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth->format('Y-m-d')) }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2">{{ old('address', $patient->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   id="city" name="city" value="{{ old('city', $patient->city) }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                   id="state" name="state" value="{{ old('state', $patient->state) }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   id="postal_code" name="postal_code" value="{{ old('postal_code', $patient->postal_code) }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact) }}">
                            @error('emergency_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="allergies" class="form-label">Allergies</label>
                            <input type="text" class="form-control @error('allergies') is-invalid @enderror" 
                                   id="allergies" name="allergies" value="{{ old('allergies', $patient->allergies) }}" placeholder="e.g., Penicillin, Latex">
                            @error('allergies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="medical_history" class="form-label">Medical History</label>
                        <textarea class="form-control @error('medical_history') is-invalid @enderror" 
                                  id="medical_history" name="medical_history" rows="3" placeholder="Previous medical conditions, surgeries, etc.">{{ old('medical_history', $patient->medical_history) }}</textarea>
                        @error('medical_history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $patient->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active Patient</label>
                        <small class="text-muted d-block">Inactive patients won't appear in regular searches</small>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Patient
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Patient Summary</h6>
            </div>
            <div class="admin-card-body">
                <div class="text-center mb-4">
                    <div class="avatar mx-auto mb-3" style="width: 60px; height: 60px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: bold;">
                        {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                    </div>
                    <h5>{{ $patient->full_name }}</h5>
                    <p class="text-muted mb-0">Patient ID: {{ $patient->patient_id }}</p>
                </div>
                
                <div class="mb-4">
                    <h6><i class="fas fa-calendar-alt me-2"></i> Visit Statistics</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Total Visits
                            <span class="badge bg-primary rounded-pill">{{ $patient->visits->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Completed
                            <span class="badge bg-success rounded-pill">{{ $patient->visits->where('status', 'completed')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Pending
                            <span class="badge bg-warning rounded-pill">{{ $patient->visits->where('status', 'scheduled')->count() }}</span>
                        </li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Important</h6>
                    <p class="mb-0 small">Updating patient information will affect all related records including visits and reports.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection