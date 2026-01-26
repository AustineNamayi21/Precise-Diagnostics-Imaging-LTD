@extends('layouts.app')

@section('title', 'Report Preview - ' . $radiologyReport->report_number)

@section('page-title', 'Report Preview')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.index') }}">Reports</a></li>
<li class="breadcrumb-item"><a href="{{ route('radiology-reports.show', $radiologyReport) }}">Details</a></li>
<li class="breadcrumb-item active">Preview</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <a href="{{ route('reports.download', $radiologyReport) }}" class="btn btn-success me-2">
        <i class="fas fa-download me-1"></i> Download PDF
    </a>
    <a href="{{ route('radiology-reports.show', $radiologyReport) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h6 class="mb-0"><i class="fas fa-eye me-2"></i> Preview</h6>
    </div>
    <div class="admin-card-body">
        <iframe
            src="{{ route('reports.download', $radiologyReport) }}"
            style="width:100%; height:80vh; border:0;"
        ></iframe>
    </div>
</div>
@endsection
