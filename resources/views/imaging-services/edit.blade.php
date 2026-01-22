@extends('layouts.admin')

@section('title', 'Edit Imaging Service - ' . $imagingService->name)

@section('page-title', 'Edit Imaging Service')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('imaging-services.index') }}">Services</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Service Information</h6>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('imaging-services.update', $imagingService) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="service_code" class="form-label">Service Code *</label>
                            <input type="text" class="form-control @error('service_code') is-invalid @enderror" 
                                   id="service_code" name="service_code" value="{{ old('service_code', $imagingService->service_code) }}" required>
                            @error('service_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Service Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $imagingService->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $imagingService->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="modality" class="form-label">Modality *</label>
                            <select class="form-select @error('modality') is-invalid @enderror" id="modality" name="modality" required>
                                <option value="">Select modality</option>
                                <option value="xray" {{ old('modality', $imagingService->modality) == 'xray' ? 'selected' : '' }}>X-Ray</option>
                                <option value="ct" {{ old('modality', $imagingService->modality) == 'ct' ? 'selected' : '' }}>CT Scan</option>
                                <option value="mri" {{ old('modality', $imagingService->modality) == 'mri' ? 'selected' : '' }}>MRI</option>
                                <option value="ultrasound" {{ old('modality', $imagingService->modality) == 'ultrasound' ? 'selected' : '' }}>Ultrasound</option>
                                <option value="mammography" {{ old('modality', $imagingService->modality) == 'mammography' ? 'selected' : '' }}>Mammography</option>
                                <option value="fluoroscopy" {{ old('modality', $imagingService->modality) == 'fluoroscopy' ? 'selected' : '' }}>Fluoroscopy</option>
                            </select>
                            @error('modality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="body_part" class="form-label">Body Part / Area</label>
                            <input type="text" class="form-control @error('body_part') is-invalid @enderror" 
                                   id="body_part" name="body_part" value="{{ old('body_part', $imagingService->body_part) }}">
                            @error('body_part')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price (₹) *</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $imagingService->price) }}" required min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="duration_minutes" class="form-label">Duration (minutes) *</label>
                            <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" 
                                   id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', $imagingService->duration_minutes) }}" required min="1">
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="preparation_instructions" class="form-label">Preparation Instructions</label>
                        <textarea class="form-control @error('preparation_instructions') is-invalid @enderror" 
                                  id="preparation_instructions" name="preparation_instructions" rows="3">{{ old('preparation_instructions', $imagingService->preparation_instructions) }}</textarea>
                        @error('preparation_instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', $imagingService->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active Service</label>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('imaging-services.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Service Statistics -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Service Statistics</h6>
            </div>
            <div class="admin-card-body">
                <div class="text-center mb-4">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                        {{ strtoupper(substr($imagingService->modality, 0, 1)) }}
                    </div>
                    <h5 class="mt-3">{{ $imagingService->name }}</h5>
                    <p class="text-muted mb-0">{{ $imagingService->service_code }}</p>
                </div>
                
                <div class="mb-4">
                    <h6><i class="fas fa-history me-2"></i> Usage Statistics</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Times Performed
                            <span class="badge bg-primary rounded-pill">{{ $imagingService->serviceRecords->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Total Revenue
                            <span class="badge bg-success rounded-pill">₹{{ number_format($imagingService->serviceRecords->count() * $imagingService->price, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Last Performed
                            <span class="badge bg-info rounded-pill">
                                @if($imagingService->serviceRecords->count() > 0)
                                    {{ $imagingService->serviceRecords->latest()->first()->created_at->format('M d, Y') }}
                                @else
                                    Never
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Important</h6>
                    <p class="mb-0 small">Changing service details will affect future visits only. Existing records will remain unchanged.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection