@extends('layouts.admin')

@section('title','Visits')
@section('page_title','Visits')
@section('page_subtitle','Create visits and attach imaging services')

@section('content')
<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div>
                    <div class="fw-bold">Visits</div>
                    <div class="text-muted small">Search by patient and date</div>
                </div>

                <div class="d-flex gap-2">
                    <form class="d-flex gap-2" method="GET" action="{{ route('admin.visits.index') }}">
                        <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Patient name / phone...">
                        <input class="form-control" type="date" name="date" value="{{ request('date') }}">
                        <button class="btn btn-pd"><i class="fa-solid fa-filter me-1"></i>Filter</button>
                    </form>
                    <a href="{{ route('admin.visits.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-plus me-1"></i>New Visit
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
                            <th>Date</th>
                            <th>Status</th>
                            <th>Imaging Services</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($visits as $v)
                            @php $p = $v->patient; @endphp
                            <tr>
                                <td class="fw-semibold">#{{ $v->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $p?->first_name }} {{ $p?->last_name }}</div>
                                    <div class="text-muted small">{{ $p?->phone }} @if($p?->email) • {{ $p->email }} @endif</div>
                                </td>
                                <td>{{ \Illuminate\Support\Carbon::parse($v->visit_date)->toDateString() }}</td>
                                <td><span class="badge badge-soft">{{ ucfirst($v->status ?? 'scheduled') }}</span></td>
                                <td class="fw-semibold">{{ $v->imagingServices?->count() ?? 0 }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.visits.show', $v) }}">
                                        <i class="fa-solid fa-eye me-1"></i>Open
                                    </a>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.visits.edit', $v) }}">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No visits found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $visits->links() ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection
