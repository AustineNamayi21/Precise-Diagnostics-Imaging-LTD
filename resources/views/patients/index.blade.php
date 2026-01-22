@extends('layouts.admin')

@section('title', 'Patients - Patient Management System')

@section('page-title', 'Patients')

@section('breadcrumbs')
<li class="breadcrumb-item active">Patients</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <form action="{{ route('patients.index') }}" method="GET" class="me-2 search-box">
        <div class="input-group">
            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search patients..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Add New Patient
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-body">
        @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Last Visit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td><strong>{{ $patient->patient_id }}</strong></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3" style="width: 40px; height: 40px; border-radius: 50%; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                        {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('patients.show', $patient) }}" class="text-decoration-none fw-medium">
                                            {{ $patient->full_name }}
                                        </a>
                                        <br>
                                        <small class="text-muted">DOB: {{ $patient->date_of_birth->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $patient->email }}</td>
                            <td>{{ $patient->phone ?? 'N/A' }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>{{ ucfirst($patient->gender) }}</td>
                            <td>
                                @if($patient->visits->count() > 0)
                                    {{ $patient->visits->first()->visit_date->format('M d, Y') }}
                                @else
                                    <span class="text-muted">No visits</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $patient->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $patient->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('patient-visits.by-patient', $patient) }}" class="btn btn-sm btn-primary" title="View Visits">
                                        <i class="fas fa-calendar"></i>
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, 'Are you sure you want to delete this patient? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $patients->firstItem() }} to {{ $patients->lastItem() }} of {{ $patients->total() }} patients
                </div>
                <div>
                    {{ $patients->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No patients found</h5>
                @if(request('search'))
                    <p>No patients match your search criteria.</p>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-primary">Clear Search</a>
                @else
                    <p>Get started by adding your first patient.</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add First Patient
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection