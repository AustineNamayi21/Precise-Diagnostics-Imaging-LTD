@extends('layouts.app')

@section('title', 'Create Radiology Report - Patient Management System')

@section('page-title', 'Create Radiology Report')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.index') }}">Reports</a></li>
<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-file-medical me-2"></i> Create New Report</h6>
            </div>
            <div class="admin-card-body">
                @if($serviceRecords->count() > 0)
                <form action="{{ route('radiology-reports.store') }}" method="POST">
                    @csrf
                    
                    <!-- Service Selection -->
                    <div class="mb-4">
                        <label for="service_record_id" class="form-label">Select Service for Reporting *</label>
                        <select class="form-select @error('service_record_id') is-invalid @enderror" id="service_record_id" name="service_record_id" required>
                            <option value="">Select a completed service</option>
                            @foreach($serviceRecords as $record)
                            <option value="{{ $record->id }}" {{ old('service_record_id') == $record->id ? 'selected' : '' }}>
                                {{ $record->visit->patient->full_name }} - 
                                {{ $record->service->name }} ({{ strtoupper($record->service->modality) }}) - 
                                {{ $record->service_date->format('M d, Y') }}
                            </option>
                            @endforeach
                        </select>
                        @error('service_record_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Only completed services without existing reports are shown</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="clinical_history" class="form-label">Clinical History</label>
                        <textarea class="form-control @error('clinical_history') is-invalid @enderror" 
                                  id="clinical_history" name="clinical_history" rows="3"
                                  placeholder="Patient's clinical history and presenting symptoms">{{ old('clinical_history') }}</textarea>
                        @error('clinical_history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="technique" class="form-label">Technique</label>
                        <textarea class="form-control @error('technique') is-invalid @enderror" 
                                  id="technique" name="technique" rows="2"
                                  placeholder="Imaging technique, protocol, and parameters used">{{ old('technique') }}</textarea>
                        @error('technique')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="findings" class="form-label">Findings *</label>
                        <textarea class="form-control @error('findings') is-invalid @enderror" 
                                  id="findings" name="findings" rows="5" required
                                  placeholder="Detailed description of imaging findings">{{ old('findings') }}</textarea>
                        @error('findings')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="impression" class="form-label">Impression / Conclusion *</label>
                        <textarea class="form-control @error('impression') is-invalid @enderror" 
                                  id="impression" name="impression" rows="3" required
                                  placeholder="Summary impression and conclusion">{{ old('impression') }}</textarea>
                        @error('impression')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="recommendations" class="form-label">Recommendations</label>
                        <textarea class="form-control @error('recommendations') is-invalid @enderror" 
                                  id="recommendations" name="recommendations" rows="2"
                                  placeholder="Recommendations for further imaging or follow-up">{{ old('recommendations') }}</textarea>
                        @error('recommendations')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priority *</label>
                            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                <option value="">Select priority</option>
                                <option value="routine" {{ old('priority') == 'routine' ? 'selected' : '' }}>Routine</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="stat" {{ old('priority') == 'stat' ? 'selected' : '' }}>STAT (Immediate)</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Note</h6>
                        <p class="mb-0">Report will be created as a draft. You can finalize it after review and approval.</p>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('radiology-reports.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save as Draft
                        </button>
                    </div>
                </form>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No services available for reporting</h5>
                    <p>All completed services already have reports or there are no completed services.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('patient-visits.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-1"></i> View Visits
                        </a>
                        <a href="{{ route('imaging-services.index') }}" class="btn btn-primary">
                            <i class="fas fa-x-ray me-1"></i> View Services
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Report Guidelines -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-book-medical me-2"></i> Report Guidelines</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-success">
                    <h6 class="alert-heading"><i class="fas fa-check-circle me-2"></i> Findings Section</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Describe all abnormalities in detail</li>
                        <li>Use anatomical terminology</li>
                        <li>Include measurements when applicable</li>
                        <li>Note normal findings for completeness</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Impression Section</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Provide clear, concise conclusions</li>
                        <li>Prioritize significant findings</li>
                        <li>Avoid ambiguous language</li>
                        <li>Include differential diagnosis if appropriate</li>
                    </ul>
                </div>
                
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-stethoscope me-2"></i> Priority Guidelines</h6>
                    <ul class="mb-0 small ps-3">
                        <li><strong>Routine:</strong> Standard reporting timeline</li>
                        <li><strong>Urgent:</strong> Requires attention within hours</li>
                        <li><strong>STAT:</strong> Immediate attention required</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Template Examples -->
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-clipboard me-2"></i> Quick Templates</h6>
            </div>
            <div class="admin-card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="loadTemplate('normal')">
                        Normal Chest X-Ray Template
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="loadTemplate('pneumonia')">
                        Pneumonia Template
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm" onclick="loadTemplate('fracture')">
                        Fracture Template
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function loadTemplate(type) {
        const templates = {
            'normal': {
                findings: 'The lungs are clear with no evidence of consolidation, pneumothorax, or pleural effusion. The cardiac silhouette is normal in size and configuration. The mediastinal contours are unremarkable. The bony structures are intact.',
                impression: 'Normal chest radiograph.'
            },
            'pneumonia': {
                findings: 'There is consolidation in the right lower lobe with air bronchograms. No pleural effusion or pneumothorax is seen. The remainder of the lungs are clear. The cardiac silhouette is normal. The bony structures are intact.',
                impression: 'Consolidation in the right lower lobe consistent with pneumonia.'
            },
            'fracture': {
                findings: 'There is a transverse fracture of the distal radius with dorsal angulation and slight shortening. The fracture line extends through the metaphysis. The articular surface appears intact. No other fractures are identified.',
                impression: 'Distal radius fracture (Colles fracture).'
            }
        };
        
        if (templates[type]) {
            document.getElementById('findings').value = templates[type].findings;
            document.getElementById('impression').value = templates[type].impression;
        }
    }
    
    // Auto-focus on findings field
    document.addEventListener('DOMContentLoaded', function() {
        const findingsField = document.getElementById('findings');
        if (findingsField) {
            findingsField.focus();
        }
    });
</script>
@endpush