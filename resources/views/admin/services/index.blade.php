@extends('layouts.admin')

@section('title','Services')
@section('page_title','Services Catalog')
@section('page_subtitle','Manage service types, modality and pricing')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Services</div>
                    <div class="text-muted small">Add or update procedures and prices</div>
                </div>

                <a class="btn btn-pd" href="{{ route('admin.services.create') }}">
                    <i class="fa-solid fa-plus me-1"></i>New Service
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Modality</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Active</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($services as $s)
                            <tr>
                                <td class="fw-semibold">{{ $s->name }}</td>
                                <td><span class="badge badge-soft">{{ $s->modality ?? '—' }}</span></td>
                                <td class="fw-semibold">KES {{ number_format($s->price ?? 0) }}</td>
                                <td class="text-muted small">{{ $s->duration_minutes ? $s->duration_minutes.' mins' : '—' }}</td>
                                <td>
                                    @if($s->is_active)
                                        <span class="badge text-bg-success">Yes</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.services.edit', $s) }}">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                    </a>
                                    <form class="d-inline" method="POST" action="{{ route('admin.services.destroy', $s) }}"
                                          data-confirm="Delete this service?">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="fa-solid fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No services found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $services->links() ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection
