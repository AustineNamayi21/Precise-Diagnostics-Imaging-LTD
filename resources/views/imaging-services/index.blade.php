@extends('layouts.app')

@section('title', 'Imaging Services - Patient Management System')

@section('page-title', 'Imaging Services')

@section('breadcrumbs')
<li class="breadcrumb-item active">Services</li>
@endsection

@section('header-actions')
<div class="d-flex">
    <form action="{{ route('imaging-services.index') }}" method="GET" class="me-2 search-box">
        <div class="input-group">
            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search services..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <a href="{{ route('imaging-services.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> New Service
    </a>
</div>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-body">
        @if($services->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Service Code</th>
                            <th>Service Name</th>
                            <th>Modality</th>
                            <th>Body Part</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <strong>{{ $service->service_code }}</strong>
                            </td>
                            <td>
                                <strong>{{ $service->name }}</strong>
                                @if($service->description)
                                <br>
                                <small class="text-muted">{{ Str::limit($service->description, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info text-uppercase">
                                    {{ $service->modality }}
                                </span>
                            </td>
                            <td>{{ $service->body_part ?? 'N/A' }}</td>
                            <td>
                                <strong>₹{{ number_format($service->price, 2) }}</strong>
                            </td>
                            <td>{{ $service->duration_minutes }} min</td>
                            <td>
                                <span class="status-badge {{ $service->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('imaging-services.edit', $service) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('imaging-services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, 'Are you sure you want to delete this service?')">
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
                    Showing {{ $services->firstItem() }} to {{ $services->lastItem() }} of {{ $services->total() }} services
                </div>
                <div>
                    {{ $services->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-x-ray fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No imaging services found</h5>
                @if(request('search'))
                    <p>No services match your search criteria.</p>
                    <a href="{{ route('imaging-services.index') }}" class="btn btn-outline-primary">Clear Search</a>
                @else
                    <p>Get started by adding your first imaging service.</p>
                    <a href="{{ route('imaging-services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add First Service
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Statistics by Modality -->
<div class="row mt-4">
    @php
        $modalities = [
            'xray' => ['name' => 'X-Ray', 'icon' => 'fas fa-radiation', 'color' => 'bg-blue-100 text-blue-800'],
            'ct' => ['name' => 'CT Scan', 'icon' => 'fas fa-brain', 'color' => 'bg-purple-100 text-purple-800'],
            'mri' => ['name' => 'MRI', 'icon' => 'fas fa-magnet', 'color' => 'bg-indigo-100 text-indigo-800'],
            'ultrasound' => ['name' => 'Ultrasound', 'icon' => 'fas fa-wave-square', 'color' => 'bg-green-100 text-green-800'],
            'mammography' => ['name' => 'Mammography', 'icon' => 'fas fa-female', 'color' => 'bg-pink-100 text-pink-800'],
            'fluoroscopy' => ['name' => 'Fluoroscopy', 'icon' => 'fas fa-video', 'color' => 'bg-yellow-100 text-yellow-800'],
        ];
    @endphp
    
    @foreach($modalities as $key => $modality)
    <div class="col-md-2 col-sm-4 mb-3">
        <div class="admin-card stat-card">
            <div class="admin-card-body text-center">
                <div class="mb-2" style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ str_replace('bg-', '', explode(' ', $modality['color'])[0]) }}20; color: {{ str_replace('text-', '', explode(' ', $modality['color'])[1]) }}; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="{{ $modality['icon'] }} fa-lg"></i>
                </div>
                <h5 class="mb-1">{{ $services->where('modality', $key)->count() }}</h5>
                <p class="text-muted mb-0 small">{{ $modality['name'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection