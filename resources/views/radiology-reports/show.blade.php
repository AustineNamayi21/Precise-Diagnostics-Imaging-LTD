@extends('layouts.app')

@section('title', 'Report Details - ' . $radiologyReport->report_number)

@section('page-title', 'Report Details')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.index') }}">Reports</a></li>
<li class="breadcrumb-item active">Details</li>
@endsection

@section('header-actions')
<div class="d-flex">
    @if($radiologyReport->isEditable())
    <a href="{{ route('radiology-reports.edit', $radiologyReport) }}" class="btn btn-warning me-2">
        <i class="fas fa-edit me-1"></i> Edit
    </a>
    @endif
    
    <a href="{{ route('reports.download', $radiologyReport) }}" class="btn btn-success me-2">
        <i class="fas fa-download me-1"></i> Download PDF
    </a>
    @if($radiologyReport->attachment_path)
    <a href="{{ route('reports.attachment.download', $radiologyReport) }}" class="btn btn-outline-success me-2">
        <i class="fas fa-paperclip me-1"></i> Download Attachment
    </a>
    @endif

    
    @if($radiologyReport->status == 'finalized' && !$radiologyReport->sent_to_patient)
    <form action="{{ route('reports.send', $radiologyReport) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary me-2">
            <i class="fas fa-paper-plane me-1"></i> Send to Patient
        </button>
    </form>
    @endif
    
    @if($radiologyReport->isEditable())
    <form action="{{ route('reports.finalize', $radiologyReport) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success me-2" onclick="return confirm('Finalize this report? This action cannot be undone.')">
            <i class="fas fa-check-circle me-1"></i> Finalize
        </button>
    </form>
    @endif
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Report Content -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-file-medical me-2"></i> Radiology Report</h6>
            </div>
            <div class="admin-card-body">
                <!-- Report Header -->
                <div class="text-center mb-4 border-bottom pb-3">
                    <h3 class="font-heading">PRECISE DIAGNOSTICS IMAGING</h3>
                    <h5 class="text-muted">RADIOLOGY REPORT</h5>
                    <p class="mb-0">
                        <strong>Report #:</strong> {{ $radiologyReport->report_number }} | 
                        <strong>Date:</strong> {{ $radiologyReport->created_at->format('F d, Y') }}
                    </p>
                </div>
                
                <!-- Patient Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-user me-2"></i> Patient Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td style="width: 40%"><strong>Name:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->visit->patient->full_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Patient ID:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->visit->patient->patient_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Age/Sex:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->visit->patient->age }} / {{ ucfirst($radiologyReport->serviceRecord->visit->patient->gender) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->visit->patient->date_of_birth->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-stethoscope me-2"></i> Exam Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td style="width: 40%"><strong>Service:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->service->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Modality:</strong></td>
                                <td>{{ strtoupper($radiologyReport->serviceRecord->service->modality) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Exam Date:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->service_date->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Referring Physician:</strong></td>
                                <td>{{ $radiologyReport->serviceRecord->visit->radiographer->name ?? 'Self-referred' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Clinical History -->
                @if($radiologyReport->clinical_history)
                <div class="mb-4">
                    <h6><i class="fas fa-history me-2"></i> Clinical History</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $radiologyReport->clinical_history }}
                    </div>
                </div>
                @endif
                
                <!-- Technique -->
                @if($radiologyReport->technique)
                <div class="mb-4">
                    <h6><i class="fas fa-tools me-2"></i> Technique</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $radiologyReport->technique }}
                    </div>
                </div>
                @endif
                
                <!-- Findings -->
                <div class="mb-4">
                    <h6><i class="fas fa-search me-2"></i> Findings</h6>
                    <div class="p-3 border rounded">
                        {!! nl2br(e($radiologyReport->findings)) !!}
                    </div>
                </div>
                
                <!-- Impression -->
                <div class="mb-4">
                    <h6><i class="fas fa-lightbulb me-2"></i> Impression</h6>
                    <div class="p-3 border rounded bg-light">
                        {!! nl2br(e($radiologyReport->impression)) !!}
                    </div>
                </div>
                
                <!-- Recommendations -->
                @if($radiologyReport->recommendations)
                <div class="mb-4">
                    <h6><i class="fas fa-comment-medical me-2"></i> Recommendations</h6>
                    <div class="p-3 border rounded">
                        {!! nl2br(e($radiologyReport->recommendations)) !!}
                    </div>
                </div>
                @endif
                
                <!-- Report Footer -->
                <div class="mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Reporting Radiologist</h6>
                            <p class="mb-1"><strong>{{ $radiologyReport->radiologist->name ?? 'Radiologist' }}</strong></p>
                            <p class="text-muted mb-0">Board Certified Radiologist</p>
                            <p class="text-muted mb-0">License: {{ $radiologyReport->radiologist->license_number ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            @if($radiologyReport->finalized_at)
                            <p class="mb-1"><strong>Finalized:</strong> {{ $radiologyReport->finalized_at->format('F d, Y h:i A') }}</p>
                            @endif
                            @if($radiologyReport->sent_to_patient)
                            <p class="mb-1"><strong>Sent to Patient:</strong> {{ $radiologyReport->sent_at->format('F d, Y h:i A') }}</p>
                            @endif
                            <p class="text-muted mb-0">Report generated by Precise Diagnostics Imaging System</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Report Metadata -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Report Information</h6>
            </div>
            <div class="admin-card-body">
                <div class="mb-4 text-center">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                        R
                    </div>
                    <h5 class="mt-3">{{ $radiologyReport->report_number }}</h5>
                    <span class="status-badge status-{{ $radiologyReport->status }}">
                        {{ ucfirst($radiologyReport->status) }}
                    </span>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">Priority</small>
                    <p class="mb-0">
                        @if($radiologyReport->priority == 'urgent')
                            <i class="fas fa-exclamation-circle me-2 text-danger"></i> Urgent
                        @elseif($radiologyReport->priority == 'stat')
                            <i class="fas fa-bolt me-2 text-warning"></i> STAT
                        @else
                            <i class="fas fa-clock me-2 text-info"></i> Routine
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">Radiologist</small>
                    <p class="mb-0">
                        <i class="fas fa-user-md me-2 text-primary"></i>
                        {{ $radiologyReport->radiologist->name ?? 'Unassigned' }}
                    </p>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">Created</small>
                    <p class="mb-0">
                        <i class="fas fa-calendar-plus me-2 text-primary"></i>
                        {{ $radiologyReport->created_at->format('M d, Y h:i A') }}
                    </p>
                </div>
                
                @if($radiologyReport->finalized_at)
                <div class="mb-3">
                    <small class="text-muted d-block">Finalized</small>
                    <p class="mb-0">
                        <i class="fas fa-check-circle me-2 text-success"></i>
                        {{ $radiologyReport->finalized_at->format('M d, Y h:i A') }}
                    </p>
                </div>
                @endif
                
                <div class="mb-3">
                    <small class="text-muted d-block">Delivery Status</small>
                    <p class="mb-0">
                        @if($radiologyReport->sent_to_patient)
                            <i class="fas fa-paper-plane me-2 text-success"></i> Sent on {{ $radiologyReport->sent_at->format('M d, Y') }}
                        @else
                            <i class="fas fa-clock me-2 text-warning"></i> Not Sent
                        @endif
                    </p>
                </div>
                
                @if($radiologyReport->amendment_notes)
                <div class="mb-3">
                    <small class="text-muted d-block">Amendment Notes</small>
                    <p class="mb-0">{{ $radiologyReport->amendment_notes }}</p>
                </div>
                @endif
                
                <hr>
                
                <!-- Quick Actions -->
                <div class="mt-4">
                    <h6><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('reports.download', $radiologyReport) }}" class="btn btn-success">
                            <i class="fas fa-download me-2"></i> Download PDF
                        </a>
                        
                        @if($radiologyReport->status == 'finalized' && !$radiologyReport->sent_to_patient)
                        <form action="{{ route('reports.send', $radiologyReport) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i> Send to Patient
                            </button>
                        </form>
                        @endif
                        
                        @if($radiologyReport->isEditable())
                        <a href="{{ route('radiology-reports.edit', $radiologyReport) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i> Edit Report
                        </a>
                        @endif
                        
                        <a href="{{ route('patients.show', $radiologyReport->serviceRecord->visit->patient) }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i> View Patient
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Patient Quick Info -->
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-user me-2"></i> Patient Information</h6>
            </div>
            <div class="admin-card-body">
                <div class="text-center mb-3">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold; margin: 0 auto;">
                        {{ substr($radiologyReport->serviceRecord->visit->patient->first_name, 0, 1) }}{{ substr($radiologyReport->serviceRecord->visit->patient->last_name, 0, 1) }}
                    </div>
                    <h6 class="mt-2 mb-1">{{ $radiologyReport->serviceRecord->visit->patient->full_name }}</h6>
                    <p class="text-muted small mb-0">ID: {{ $radiologyReport->serviceRecord->visit->patient->patient_id }}</p>
                </div>
                
                <div class="small">
                    <p class="mb-1">
                        <i class="fas fa-phone me-2 text-muted"></i>
                        {{ $radiologyReport->serviceRecord->visit->patient->phone ?? 'N/A' }}
                    </p>
                    <p class="mb-1">
                        <i class="fas fa-envelope me-2 text-muted"></i>
                        {{ $radiologyReport->serviceRecord->visit->patient->email }}
                    </p>
                    <p class="mb-1">
                        <i class="fas fa-birthday-cake me-2 text-muted"></i>
                        {{ $radiologyReport->serviceRecord->visit->patient->age }} years
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection