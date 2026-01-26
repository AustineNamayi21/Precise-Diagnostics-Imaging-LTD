@extends('layouts.admin')

@section('title','Imaging Services')
@section('page_title','Imaging Services')
@section('page_subtitle','Track all ordered/performed imaging procedures')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Imaging Services</div>
                    <div class="text-muted small">Search by patient and status</div>
                </div>

                <form class="d-flex gap-2" method="GET" action="{{ route('admin.imaging-services.index') }}">
                    <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Patient name / service...">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        @foreach(['ordered','performed','reported','cancelled'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-pd"><i class="fa-solid fa-filter me-1"></i>Filter</button>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Service</th>
                            <th>Visit</th>
                            <th>Status</th>
                            <th>Report</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($imagingServices as $img)
                            @php
                                $p = $img->visit?->patient;
                                $s = $img->service;
                            @endphp
                            <tr>
                                <td class="fw-semibold">#{{ $img->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $p?->first_name }} {{ $p?->last_name }}</div>
                                    <div class="text-muted small">{{ $p?->phone }}</div>
                                </td>
                                <td>{{ $s?->name ?? '—' }}</td>
                                <td class="text-muted small">
                                    <a href="{{ route('admin.visits.show', $img->visit_id) }}" class="text-decoration-none">
                                        Visit #{{ $img->visit_id }}
                                    </a>
                                </td>
                                <td><span class="badge badge-soft">{{ ucfirst($img->status ?? 'ordered') }}</span></td>
                                <td>
                                    @if($img->report)
                                        <span class="badge text-bg-success">Yes</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.imaging-services.show', $img) }}">
                                        <i class="fa-solid fa-eye me-1"></i>Open
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">No imaging services found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $imagingServices->links() ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection
