@extends('layouts.admin')

@section('title','Reports')
@section('page_title','Radiology Reports')
@section('page_subtitle','Create, finalize and deliver reports securely')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Reports</div>
                    <div class="text-muted small">Track report status and downloads</div>
                </div>

                <form class="d-flex gap-2" method="GET">
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        @foreach(['draft','final'] as $s)
                            <option value="{{ $s }}" @selected(request('status')===$s)>{{ strtoupper($s) }}</option>
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
                            <th>Status</th>
                            <th>Attachment</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reports as $r)
                            @php
                                $patient = $r->imagingService?->visit?->patient;
                                $service = $r->imagingService?->service;
                            @endphp
                            <tr>
                                <td class="fw-semibold">#{{ $r->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $patient?->first_name }} {{ $patient?->last_name }}</div>
                                    <div class="text-muted small">
                                        {{ $patient?->phone }}
                                        @if($patient?->email) • {{ $patient->email }} @endif
                                    </div>
                                </td>
                                <td>{{ $service?->name ?? '—' }}</td>
                                <td>
                                    <span class="badge {{ $r->status === 'final' ? 'text-bg-success' : 'text-bg-warning' }}">
                                        {{ strtoupper($r->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($r->attachment_path)
                                        <span class="badge text-bg-primary">Yes</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.radiology-reports.show', $r) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.radiology-reports.edit', $r) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No reports found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
