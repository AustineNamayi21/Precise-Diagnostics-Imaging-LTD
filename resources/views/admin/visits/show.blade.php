@extends('layouts.admin')

@section('title','Visit')
@section('page_title','Visit Details')
@section('page_subtitle','Attach imaging services, billing, and payments')

@section('content')
@php
    $patient = $visit->patient;
    $services = $services ?? [];
    $invoice = $visit->invoice ?? null;

    $statusBadge = function ($status) {
        $status = strtolower($status ?? 'unpaid');
        return match ($status) {
            'paid' => 'text-bg-success',
            'partial' => 'text-bg-warning',
            'unpaid' => 'text-bg-secondary',
            default => 'text-bg-info',
        };
    };
@endphp

<div class="row g-3">
    <!-- LEFT COLUMN -->
    <div class="col-12 col-lg-5">

        <!-- Visit Info -->
        <div class="card pd-card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">Visit #{{ $visit->id }}</div>
                <span class="badge badge-soft">{{ ucfirst($visit->status ?? 'scheduled') }}</span>
            </div>

            <div class="card-body">
                <div class="mb-2 text-muted small">Patient</div>
                <div class="fw-bold h5 mb-1">
                    {{ $patient?->first_name }} {{ $patient?->last_name }}
                </div>
                <div class="text-muted small">
                    {{ $patient?->phone }}
                    @if($patient?->email) • {{ $patient->email }} @endif
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-muted small">Visit Date</div>
                        <div class="fw-semibold">
                            {{ \Illuminate\Support\Carbon::parse($visit->visit_date)->toDateString() }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="text-muted small">Services Count</div>
                        <div class="fw-semibold">{{ $visit->imagingServices?->count() ?? 0 }}</div>
                    </div>

                    <div class="col-12">
                        <div class="text-muted small">Notes</div>
                        <div class="fw-semibold">{{ $visit->clinical_notes ?? '—' }}</div>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-secondary"
                       href="{{ route('admin.visits.edit', $visit->id) }}">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit Visit
                    </a>

                    @if($patient)
                        <a class="btn btn-outline-secondary"
                           href="{{ route('admin.patients.show', $patient->id) }}">
                            <i class="fa-solid fa-user me-1"></i>Patient
                        </a>
                    @endif

                    <a class="btn btn-outline-secondary"
                       href="{{ route('admin.visits.index') }}">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Add Imaging Service -->
        <div class="card pd-card mb-3">
            <div class="card-header">
                <div class="fw-bold">
                    <i class="fa-solid fa-plus me-2"></i>Add Imaging Service
                </div>
                <div class="text-muted small">Attach service to this visit</div>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('admin.visits.imaging-services.store', $visit->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Service</label>
                        <select class="form-select" name="service_id" required>
                            <option value="">Select service...</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->name }} • KES {{ number_format($s->price ?? 0) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select" name="status">
                            @foreach(['ordered','performed','reported','cancelled'] as $st)
                                <option value="{{ $st }}">{{ ucfirst($st) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-pd w-100">
                        <i class="fa-solid fa-link me-2"></i>Attach Service
                    </button>
                </form>
            </div>
        </div>

        <!-- Billing & Payments -->
        <div class="card pd-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fw-bold">
                    <i class="fa-solid fa-receipt me-2"></i>Billing & Payments
                </div>

                <form method="POST" action="{{ route('admin.billing.sync', $visit->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-warning">
                        <i class="fa-solid fa-rotate me-1"></i>Sync Invoice
                    </button>
                </form>
            </div>

            <div class="card-body">
                @if(!$invoice)
                    <div class="text-muted">
                        No invoice yet. Click <b>Sync Invoice</b> to generate one.
                    </div>
                @else
                    @php
                        $paid = (float) ($invoice->payments?->sum('amount') ?? 0);
                        $subtotal = (float) ($invoice->subtotal ?? 0);
                        $discount = (float) ($invoice->discount ?? 0);
                        $total = (float) ($invoice->total ?? 0);
                        $balance = max($total - $paid, 0);
                    @endphp

                    <div class="mb-2 d-flex flex-wrap gap-2">
                        <span class="badge text-bg-secondary">Invoice {{ $invoice->invoice_number }}</span>
                        <span class="badge {{ $statusBadge($invoice->status) }}">Status: {{ ucfirst($invoice->status) }}</span>
                        <span class="badge text-bg-dark">Subtotal: KES {{ number_format($subtotal, 2) }}</span>
                        <span class="badge text-bg-secondary">Discount: KES {{ number_format($discount, 2) }}</span>
                        <span class="badge text-bg-success">Total: KES {{ number_format($total, 2) }}</span>
                        <span class="badge text-bg-warning">Balance: KES {{ number_format($balance, 2) }}</span>
                    </div>

                    <div class="text-muted small mb-3">
                        Issued: {{ optional($invoice->issued_at)->format('Y-m-d H:i') ?? '—' }}
                        @if($invoice->issuer?->name)
                            • By: {{ $invoice->issuer->name }}
                        @endif
                    </div>

                    <!-- Invoice Items -->
                    <table class="table table-sm align-middle mb-3">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Unit</th>
                                <th class="text-end">Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoice->items ?? [] as $item)
                                <tr>
                                    <td>{{ $item->description }}</td>
                                    <td class="text-end">{{ (int)($item->quantity ?? 1) }}</td>
                                    <td class="text-end">KES {{ number_format((float)($item->unit_price ?? 0), 2) }}</td>
                                    <td class="text-end">KES {{ number_format((float)($item->line_total ?? 0), 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        No invoice items yet. Click <b>Sync Invoice</b>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Record Payment -->
                    <form method="POST" action="{{ route('admin.invoices.payments.store', $invoice->id) }}">
                        @csrf

                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="number"
                                       step="0.01"
                                       min="1"
                                       name="amount"
                                       class="form-control"
                                       value="{{ $balance > 0 ? $balance : '' }}"
                                       placeholder="Amount (KES)"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <select name="method" class="form-select" required>
                                    <option value="cash">Cash</option>
                                    <option value="mpesa">Mpesa</option>
                                    <option value="card">Card</option>
                                    <option value="bank">Bank</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="text"
                                       name="reference"
                                       class="form-control"
                                       placeholder="Reference (optional)">
                            </div>

                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-pd mt-2">
                                    <i class="fa-solid fa-circle-check me-2"></i>Save Payment
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Payments -->
                    <hr>

                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Method</th>
                                <th class="text-end">Amount</th>
                                <th>Received By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoice->payments ?? [] as $p)
                                <tr>
                                    <td>{{ optional($p->paid_at)->format('Y-m-d H:i') }}</td>
                                    <td>{{ ucfirst($p->method) }}</td>
                                    <td class="text-end">KES {{ number_format((float)$p->amount, 2) }}</td>
                                    <td>{{ $p->receiver?->name ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        No payments yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="col-12 col-lg-7">
        <div class="card pd-card">
            <div class="card-header">
                <div class="fw-bold">Imaging Services</div>
                <div class="text-muted small">Reports per service</div>
            </div>

            <div class="card-body table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Report</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visit->imagingServices ?? [] as $img)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $img->service?->name }}</div>
                                    <div class="text-muted small">
                                        KES {{ number_format($img->service?->price ?? 0) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft">
                                        {{ ucfirst($img->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($img->report)
                                        <span class="badge text-bg-success">Yes</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary"
                                       href="{{ route('admin.imaging-services.show', $img->id) }}">
                                        Open
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No services attached yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
