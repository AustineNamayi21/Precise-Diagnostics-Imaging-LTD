@extends('layouts.admin')

@section('title', 'Edit Report - ' . $radiologyReport->report_number)

@section('page-title', 'Edit Radiology Report')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.index') }}">Reports</a></li>
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.show', $radiologyReport) }}">Details</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Report</h6>
            </div>
            <div class="admin-card-body">
                @if(!$radiologyReport->isEditable())
                <div class="alert alert-danger">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-circle me-2"></i> Report Not Editable</h6>
                    <p class="mb-0">This report has been finalized and cannot be edited. To make changes, you may need to create an amended report.</p>
                </div>
                @else
                <form action="{{ route('radiology-reports.update', $radiologyReport) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Read-only Information -->
                    <div class="mb-4">
                        <label class="form-label">Patient Information</label>
                        <div class="form-control bg-light">
                            <strong>{{ $radiologyReport->serviceRecord->visit->patient->full_name }}</strong><br>
                            <small class="text-muted">ID: {{ $radiologyReport->serviceRecord->visit->patient->patient_id }} | 
                            Service: {{ $radiologyReport->serviceRecord->service->name }} | 
                            Exam Date: {{ $radiologyReport->serviceRecord->service_date->format('M d, Y') }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="clinical_history" class="form-label">Clinical History</label>
                        <textarea class="form-control @error('clinical_history') is-invalid @enderror" 
                                  id="clinical_history" name="clinical_history" rows="3">{{ old('clinical_history', $radiologyReport->clinical_history) }}</textarea>
                        @error('clinical_history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="technique" class="form-label">Technique</label>
                        <textarea class="form-control @error('technique') is-invalid @enderror" 
                                  id="technique" name="technique" rows="2">{{ old('technique', $radiologyReport->technique) }}</textarea>
                        @error('technique')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="findings" class="form-label">Findings *</label>
                        <textarea class="form-control @error('findings') is-invalid @enderror" 
                                  id="findings" name="findings" rows="5" required>{{ old('findings', $radiologyReport->findings) }}</textarea>
                        @error('findings')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="impression" class="form-label">Impression / Conclusion *</label>
                        <textarea class="form-control @error('impression') is-invalid @enderror" 
                                  id="impression" name="impression" rows="3" required>{{ old('impression', $radiologyReport->impression) }}</textarea>
                        @error('impression')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="recommendations" class="form-label">Recommendations</label>
                        <textarea class="form-control @error('recommendations') is-invalid @enderror" 
                                  id="recommendations" name="recommendations" rows="2">{{ old('recommendations', $radiologyReport->recommendations) }}</textarea>
                        @error('recommendations')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priority *</label>
                            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                <option value="">Select priority</option>
                                <option value="routine" {{ old('priority', $radiologyReport->priority) == 'routine' ? 'selected' : '' }}>Routine</option>
                                <option value="urgent" {{ old('priority', $radiologyReport->priority) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="stat" {{ old('priority', $radiologyReport->priority) == 'stat' ? 'selected' : '' }}>STAT (Immediate)</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Important</h6>
                        <p class="mb-0">Remember to finalize the report after completing your edits. Only finalized reports can be sent to patients.</p>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('radiology-reports.show', $radiologyReport) }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Report Status -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i> Report Status</h6>
            </div>
            <div class="admin-card-body">
                <div class="text-center mb-4">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                        R
                    </div>
                    <h5 class="mt-3">{{ $radiologyReport->report_number }}</h5>
                    <span class="status-badge status-{{ $radiologyReport->status }}">
                        {{ ucfirst($radiologyReport->status) }}
                    </span>
                </div>
                
                <div class="mb-4">
                    <h6><i class="fas fa-history me-2"></i> Report Timeline</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Created
                            <span class="badge bg-info rounded-pill">
                                {{ $radiologyReport->created_at->format('M d, Y') }}
                            </span>
                        </li>
                        @if($radiologyReport->finalized_at)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Finalized
                            <span class="badge bg-success rounded-pill">
                                {{ $radiologyReport->finalized_at->format('M d, Y') }}
                            </span>
                        </li>
                        @endif
                        @if($radiologyReport->sent_to_patient)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Sent to Patient
                            <span class="badge bg-primary rounded-pill">
                                {{ $radiologyReport->sent_at->format('M d, Y') }}
                            </span>
                        </li>
                        @endif
                    </ul>
                </div>
                
                <!-- Quick Actions -->
                <div class="mt-4">
                    <h6><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
                    <div class="d-grid gap-2">
                        @if($radiologyReport->isEditable())
                        <form action="{{ route('radiology-reports.finalize', $radiologyReport) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success w-100" onclick="return confirm('Finalize this report? This action cannot be undone.')">
                                <i class="fas fa-check-circle me-2"></i> Finalize Report
                            </button>
                        </form>
                        @endif
                        
                        <a href="{{ route('reports.download', $radiologyReport) }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-download me-2"></i> Download PDF
                        </a>
                        
                        <a href="{{ route('radiology-reports.show', $radiologyReport) }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i> View Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Editing Guidelines -->
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-book-medical me-2"></i> Editing Guidelines</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Important Notes</h6>
                    <ul class="mb-0 small ps-3">
                        <li>Double-check measurements and calculations</li>
                        <li>Ensure anatomical terminology is correct</li>
                        <li>Verify patient information is accurate</li>
                        <li>Review for typographical errors</li>
                        <li>Consider peer review for complex cases</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-save draft functionality
    let autoSaveTimer;
    const form = document.querySelector('form');
    
    function autoSave() {
        if (form) {
            const formData = new FormData(form);
            formData.append('_method', 'PUT');
            
            fetch('{{ route("radiology-reports.update", $radiologyReport) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Auto-saved at ' + new Date().toLocaleTimeString());
                }
            })
            .catch(error => console.error('Auto-save error:', error));
        }
    }
    
    // Start auto-save timer (every 2 minutes)
    if (form) {
        form.addEventListener('input', () => {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(autoSave, 120000); // 2 minutes
        });
    }
    
    // Add word count for findings and impression
    function updateWordCount(textareaId, displayId) {
        const textarea = document.getElementById(textareaId);
        const display = document.getElementById(displayId);
        
        if (textarea && display) {
            textarea.addEventListener('input', function() {
                const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                display.textContent = `${words.length} words`;
            });
            
            // Initial count
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            display.textContent = `${words.length} words`;
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        updateWordCount('findings', 'findings-word-count');
        updateWordCount('impression', 'impression-word-count');
    });
</script>
@endpush