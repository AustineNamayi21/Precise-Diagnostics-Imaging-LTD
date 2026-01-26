@extends('layouts.app')

@section('title', 'Imaging Service Details - ' . $imagingService->name)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="admin-card">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-x-ray me-2"></i> 
                        {{ $imagingService->name }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('imaging-services.edit', $imagingService) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('imaging-services.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="admin-card-body">
                    <div class="row">
                        <!-- Left Column: Basic Information -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Service Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Service Code:</th>
                                    <td><code class="bg-light p-1 rounded">{{ $imagingService->service_code }}</code></td>
                                </tr>
                                <tr>
                                    <th>Service Name:</th>
                                    <td>{{ $imagingService->name }}</td>
                                </tr>
                                <tr>
                                    <th>Modality:</th>
                                    <td>
                                        <span class="badge bg-primary text-uppercase">
                                            {{ $imagingService->modality }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Body Part:</th>
                                    <td>{{ $imagingService->body_part ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td class="fw-bold text-success">
                                        ₹{{ number_format($imagingService->price, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Duration:</th>
                                    <td>{{ $imagingService->duration_minutes }} minutes</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($imagingService->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <!-- Right Column: Description & Instructions -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Description & Instructions</h6>
                            
                            <div class="mb-4">
                                <p class="text-muted small mb-2">Description:</p>
                                <div class="bg-light p-3 rounded">
                                    @if($imagingService->description)
                                        {{ $imagingService->description }}
                                    @else
                                        <span class="text-muted">No description provided.</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <p class="text-muted small mb-2">Preparation Instructions:</p>
                                <div class="bg-light p-3 rounded">
                                    @if($imagingService->preparation_instructions)
                                        {!! nl2br(e($imagingService->preparation_instructions)) !!}
                                    @else
                                        <span class="text-muted">No preparation instructions provided.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Metadata Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="text-muted mb-3">Service Metadata</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="20%">Created:</th>
                                    <td>{{ $imagingService->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $imagingService->updated_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('imaging-services.edit', $imagingService) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i> Edit Service
                                </a>
                                <a href="{{ route('imaging-services.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-list me-1"></i> View All Services
                                </a>
                            </div>
                            
                            <form action="{{ route('imaging-services.destroy', $imagingService) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this imaging service? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-1"></i> Delete Service
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection