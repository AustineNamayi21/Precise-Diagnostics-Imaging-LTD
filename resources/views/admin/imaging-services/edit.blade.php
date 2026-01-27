@extends('layouts.admin')

@section('title','Edit Imaging Service')
@section('page_title','Edit Imaging Service')
@section('page_subtitle','Update exam details for this visit')

@section('content')
@php
    $visit = $imagingService->visit;
    $patient = $visit?->patient;
@endphp

<div class="row g-3">
    <div class="col-12" data-aos="fade-up">
        <div class="card pd-card">
            <div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">
                        <i class="fa-solid fa-pen-to-square me-2"></i>
                        Edit Imaging Service
                    </div>
                    <div class="text-muted small">
                        Visit #{{ $visit?->id ?? '—' }}
                        • {{ $patient?->first_name }} {{ $patient?->last_name }}
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.imaging-services.show', $imagingService) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.imaging-services.update', $imagingService) }}" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Service / Procedure</label>
                        <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" required>
                            <option value="" disabled>Select a service…</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc->id }}" @selected(old('service_id', $imagingService->service_id) == $svc->id)>
                                    {{ $svc->name }} ({{ $svc->modality }}) — KES {{ number_format((float)$svc->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-lg-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach(['ordered','performed','reported','delivered','cancelled'] as $st)
                                <option value="{{ $st }}" @selected(old('status', $imagingService->status) === $st)>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-lg-3">
                        <label class="form-label">Price Override (optional)</label>
                        <input type="number" step="0.01" name="price_override"
                               value="{{ old('price_override', $imagingService->price_override) }}"
                               class="form-control @error('price_override') is-invalid @enderror"
                               placeholder="e.g. 15000">
                        @error('price_override')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Ordered At (optional)</label>
                        <input type="datetime-local" name="ordered_at"
                               value="{{ old('ordered_at', optional($imagingService->ordered_at)->format('Y-m-d\TH:i')) }}"
                               class="form-control @error('ordered_at') is-invalid @enderror">
                        @error('ordered_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Performed At (optional)</label>
                        <input type="datetime-local" name="performed_at"
                               value="{{ old('performed_at', optional($imagingService->performed_at)->format('Y-m-d\TH:i')) }}"
                               class="form-control @error('performed_at') is-invalid @enderror">
                        @error('performed_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes (optional)</label>
                        <textarea name="notes" rows="4"
                                  class="form-control @error('notes') is-invalid @enderror"
                                  placeholder="Clinical notes / protocol / findings…">{{ old('notes', $imagingService->notes) }}</textarea>
                        @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('admin.imaging-services.show', $imagingService) }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
