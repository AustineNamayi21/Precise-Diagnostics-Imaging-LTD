@extends('layouts.app')

@section('title', 'Add New Imaging Service - Patient Management System')

@section('page-title', 'Add New Imaging Service')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('imaging-services.index') }}">Services</a></li>
<li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-x-ray me-2"></i> Service Information</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('imaging-services.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="service_code" class="form-label">Service Code *</label>
                            <input type="text" class="form-control @error('service_code') is-invalid @enderror" 
                                   id="service_code" name="service_code" value="{{ old('service_code') }}" required
                                   placeholder="e.g., XRAY-CHEST, MRI-BRAIN">
                            @error('service_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Unique identifier for the service</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Service Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required
                                   placeholder="e.g., Chest X-Ray, Brain MRI">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3"
                                  placeholder="Brief description of the service">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modality" class="form-label">Modality *</label>
                            <select class="form-select @error('modality') is-invalid @enderror" id="modality" name="modality" required>
                                <option value="">Select modality</option>
                                <option value="xray" {{ old('modality') == 'xray' ? 'selected' : '' }}>X-Ray</option>
                                <option value="ct" {{ old('modality') == 'ct' ? 'selected' : '' }}>CT Scan</option>
                                <option value="mri" {{ old('modality') == 'mri' ? 'selected' : '' }}>MRI</option>
                                <option value="ultrasound" {{ old('modality') == 'ultrasound' ? 'selected' : '' }}>Ultrasound</option>
                                <option value="mammography" {{ old('modality') == 'mammography' ? 'selected' : '' }}>Mammography</option>
                                <option value="fluoroscopy" {{ old('modality') == 'fluoroscopy' ? 'selected' : '' }}>Fluoroscopy</option>
                            </select>
                            @error('modality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="body_part" class="form-label">Body Part / Area</label>
                            <input type="text" class="form-control @error('body_part') is-invalid @enderror" 
                                   id="body_part" name="body_part" value="{{ old('body_part') }}"
                                   placeholder="e.g., Chest, Brain, Abdomen">
                            @error('body_part')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price (₹) *</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="duration_minutes" class="form-label">Duration (minutes) *</label>
                            <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                   id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" required min="1">
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Estimated duration for the procedure</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="preparation_instructions" class="form-label">Preparation Instructions</label>
                        <textarea class="form-control @error('preparation_instructions') is-invalid @enderror" 
                                  id="preparation_instructions" name="preparation_instructions" rows="3"
                                  placeholder="Patient preparation instructions (e.g., fasting, clothing requirements)">{{ old('preparation_instructions') }}</textarea>
                        @error('preparation_instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active Service</label>
                        <small class="text-muted d-block">Inactive services won't be available for selection</small>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('imaging-services.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Service Guidelines</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-lightbulb me-2"></i> Tips for Service Codes</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Use consistent naming convention</li>
                        <li>Include modality in code (XRAY, MRI, CT)</li>
                        <li>Include body part (CHEST, BRAIN, ABDOMEN)</li>
                        <li>Example: XRAY-CHEST, MRI-BRAIN, CT-ABDOMEN</li>
                    </ul>
                </div>
                
                <div class="alert alert-success">
                    <h6 class="alert-heading"><i class="fas fa-money-bill-wave me-2"></i> Pricing Guidelines</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Research competitor pricing</li>
                        <li>Consider equipment and staff costs</li>
                        <li>Include interpretation fees if applicable</li>
                        <li>Review and update prices periodically</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fas fa-clock me-2"></i> Duration Guidelines</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Include preparation time</li>
                        <li>Consider patient positioning time</li>
                        <li>Include image acquisition time</li>
                        <li>Allow buffer for unexpected delays</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection