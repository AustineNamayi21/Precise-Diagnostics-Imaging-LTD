@extends('layouts.admin')

@section('title', 'Add New Patient - Patient Management System')

@section('page-title', 'Add New Patient')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('patients.index') }}">Patients</a></li>
<li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i> Patient Information</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth *</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   id="city" name="city" value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                   id="state" name="state" value="{{ old('state') }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}">
                            @error('emergency_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="allergies" class="form-label">Allergies</label>
                            <input type="text" class="form-control @error('allergies') is-invalid @enderror" 
                                   id="allergies" name="allergies" value="{{ old('allergies') }}" placeholder="e.g., Penicillin, Latex">
                            @error('allergies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="medical_history" class="form-label">Medical History</label>
                        <textarea class="form-control @error('medical_history') is-invalid @enderror" 
                                  id="medical_history" name="medical_history" rows="3" placeholder="Previous medical conditions, surgeries, etc.">{{ old('medical_history') }}</textarea>
                        @error('medical_history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active Patient</label>
                        <small class="text-muted d-block">Inactive patients won't appear in regular searches</small>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Patient
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Quick Tips</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-lightbulb me-2"></i> Important Notes</h6>
                    <ul class="mb-0 ps-3">
                        <li>Patient ID will be automatically generated</li>
                        <li>All fields marked with * are required</li>
                        <li>Ensure email is unique for each patient</li>
                        <li>Complete medical history helps in better diagnosis</li>
                        <li>Emergency contact is crucial for critical situations</li>
                    </ul>
                </div>
                
                <div class="alert alert-success">
                    <h6 class="alert-heading"><i class="fas fa-user-check me-2"></i> After Creation</h6>
                    <p class="mb-0">After creating a patient, you can:</p>
                    <ul class="mb-0 ps-3">
                        <li>Schedule their first visit</li>
                        <li>Add imaging services</li>
                        <li>Generate radiology reports</li>
                        <li>Send reports via email</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection