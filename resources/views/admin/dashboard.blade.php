@extends('layouts.admin')

@section('title','Dashboard')
@section('page_title','Admin Dashboard')
@section('page_subtitle','Notices & updates')

@section('content')
@php
    $notices = $notices ?? collect();
@endphp

<div class="row g-3">
    {{-- Flash + Validation --}}
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success mb-0">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-0">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-2 mb-0">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                Please fix the errors and try again.
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Post Notice --}}
    <div class="col-12 col-lg-5" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">
                    <i class="fa-solid fa-bullhorn me-2"></i>Post a Notice
                </div>
                <span class="badge text-bg-secondary">Admin</span>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.notices.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title (optional)</label>
                        <input type="text"
                               class="form-control"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="e.g. CT maintenance at 2PM">
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message</label>
                        <textarea class="form-control"
                                  name="message"
                                  rows="6"
                                  required
                                  placeholder="Write your notice here...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type</label>
                            <select class="form-select" name="level" required>
                                @foreach(['info'=>'Info','success'=>'Success','warning'=>'Warning','danger'=>'Urgent'] as $k => $v)
                                    <option value="{{ $k }}" @selected(old('level','info') === $k)>{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('level')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check me-3">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_pinned"
                                       id="pinNotice"
                                       value="1"
                                       @checked(old('is_pinned'))>
                                <label class="form-check-label fw-semibold" for="pinNotice">Pin</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_active"
                                       id="activeNotice"
                                       value="1"
                                       checked>
                                <label class="form-check-label fw-semibold" for="activeNotice">Active</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pd w-100">
                        <i class="fa-solid fa-paper-plane me-2"></i>Publish Notice
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Notices List --}}
    <div class="col-12 col-lg-7" data-aos="fade-up" data-aos-delay="50">
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">
                        <i class="fa-solid fa-note-sticky me-2"></i>Notices
                    </div>
                    <div class="text-muted small">Editable dashboard messages</div>
                </div>
                <span class="badge text-bg-secondary">{{ $notices->count() }} active</span>
            </div>

            <div class="card-body">
                @forelse($notices as $n)
                    @php
                        $levelClass = match($n->level) {
                            'success' => 'alert-success',
                            'warning' => 'alert-warning',
                            'danger'  => 'alert-danger',
                            default   => 'alert-info'
                        };
                        $id = $n->id; // migration uses default id()
                    @endphp

                    <div class="alert {{ $levelClass }} d-flex justify-content-between align-items-start gap-3">
                        <div class="w-100">
                            <div class="d-flex align-items-center gap-2">
                                <div class="fw-bold">
                                    {{ $n->title ?: 'Notice' }}
                                </div>

                                @if($n->is_pinned)
                                    <span class="badge text-bg-dark">
                                        <i class="fa-solid fa-thumbtack me-1"></i>Pinned
                                    </span>
                                @endif

                                @if(!$n->is_active)
                                    <span class="badge text-bg-secondary">Inactive</span>
                                @endif
                            </div>

                            <div class="mt-2">
                                {!! nl2br(e($n->message)) !!}
                            </div>

                            <div class="small text-muted mt-2">
                                Posted: {{ optional($n->created_at)->format('Y-m-d H:i') ?? '—' }}
                                @if(optional($n->creator)->name)
                                    • By {{ $n->creator->name }}
                                @endif
                            </div>
                        </div>

                        <div class="text-nowrap">
                            <button type="button"
                                    class="btn btn-sm btn-outline-dark"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editNotice{{ $id }}">
                                <i class="fa-solid fa-pen me-1"></i>Edit
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.notices.destroy', ['notice' => $id]) }}"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this notice?');">
                                    <i class="fa-solid fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editNotice{{ $id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Notice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="{{ route('admin.notices.update', ['notice' => $id]) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Title</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="title"
                                                   value="{{ $n->title }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Message</label>
                                            <textarea class="form-control"
                                                      name="message"
                                                      rows="6"
                                                      required>{{ $n->message }}</textarea>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Type</label>
                                                <select class="form-select" name="level" required>
                                                    @foreach(['info'=>'Info','success'=>'Success','warning'=>'Warning','danger'=>'Urgent'] as $k => $v)
                                                        <option value="{{ $k }}" @selected($n->level === $k)>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 d-flex align-items-end">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           name="is_pinned"
                                                           value="1"
                                                           id="pin{{ $id }}"
                                                           @checked($n->is_pinned)>
                                                    <label class="form-check-label fw-semibold" for="pin{{ $id }}">Pin</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           name="is_active"
                                                           value="1"
                                                           id="active{{ $id }}"
                                                           @checked($n->is_active)>
                                                    <label class="form-check-label fw-semibold" for="active{{ $id }}">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-pd">
                                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="fa-regular fa-note-sticky fa-2x mb-2"></i>
                        <div class="fw-semibold">No active notices yet</div>
                        <div class="small">Post one from the left panel.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
