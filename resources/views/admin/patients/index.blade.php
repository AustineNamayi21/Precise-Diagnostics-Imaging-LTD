@extends('layouts.admin')

@section('title','Patients')
@section('page_title','Patients')
@section('page_subtitle','Register and manage patient profiles')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Patients</div>
                    <div class="text-muted small">Search and open patient record</div>
                </div>

                <div class="d-flex gap-2">
                    <form class="d-flex gap-2" method="GET" action="{{ route('admin.patients.index') }}">
                        <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Search name, phone, email...">
                        <button class="btn btn-pd"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                    </form>

                    <a href="{{ route('admin.patients.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-user-plus me-1"></i>New Patient
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Contacts</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($patients as $p)
                            <tr>
                                <td class="fw-semibold">#{{ $p->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $p->first_name }} {{ $p->last_name }}</div>
                                    <div class="text-muted small">{{ $p->patient_number ?? '' }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $p->phone }}</div>
                                    <div class="text-muted small">{{ $p->email ?? '—' }}</div>
                                </td>
                                <td class="text-muted small">{{ optional($p->created_at)->format('Y-m-d') }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.patients.show', $p) }}">
                                        <i class="fa-solid fa-eye me-1"></i>View
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.patients.edit', $p) }}">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                    </a>
                                    <form class="d-inline" method="POST" action="{{ route('admin.patients.destroy', $p) }}"
                                          data-confirm="Delete this patient? This may affect visits and reports.">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">
                                            <i class="fa-solid fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No patients found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $patients->links() ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection
