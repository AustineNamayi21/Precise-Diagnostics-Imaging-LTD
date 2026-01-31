<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillingService
{
    public function syncInvoiceForVisit(Visit $visit): Invoice
    {
        return DB::transaction(function () use ($visit) {

            $visit->loadMissing('imagingServices.service');

            // ✅ Create invoice if missing (matches invoices table EXACTLY)
            $invoice = Invoice::firstOrCreate(
                ['visit_id' => $visit->id],
                [
                    'patient_id'   => $visit->patient_id,
                    'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                    'subtotal'     => 0,
                    'discount'     => 0,
                    'total'        => 0,
                    'status'       => 'unpaid',
                    'issued_at'    => now(),
                    'issued_by'    => auth()->id(),
                ]
            );

            // Safety backfill
            if (!$invoice->issued_at) {
                $invoice->issued_at = now();
            }
            if (!$invoice->issued_by && auth()->check()) {
                $invoice->issued_by = auth()->id();
            }
            $invoice->save();

            // 🔁 Rebuild invoice items cleanly
            $invoice->items()->delete();

            foreach ($visit->imagingServices as $img) {
                $price = (float) ($img->price_override ?? $img->service?->price ?? 0);
                $qty   = 1;

                InvoiceItem::create([
                    'invoice_id'         => $invoice->id,
                    'imaging_service_id' => $img->id,      // ✅ REQUIRED
                    'description'        => $img->service?->name ?? 'Service',
                    'quantity'           => $qty,
                    'unit_price'         => $price,
                    'line_total'         => $qty * $price, // ✅ REQUIRED
                ]);
            }

            // ✅ Correct subtotal calculation
            $subtotal = (float) $invoice->items()->sum('line_total');
            $discount = (float) ($invoice->discount ?? 0);
            $total    = max($subtotal - $discount, 0);

            $invoice->update([
                'subtotal' => $subtotal,
                'total'    => $total,
            ]);

            // ✅ Update status from payments
            $paid = (float) $invoice->payments()->sum('amount');

            $invoice->update([
                'status' => $paid <= 0
                    ? 'unpaid'
                    : ($paid >= $invoice->total ? 'paid' : 'partial'),
            ]);

            return $invoice;
        });
    }

    public function recordPayment(Invoice $invoice, array $data): Payment
    {
        return DB::transaction(function () use ($invoice, $data) {

            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'amount'     => $data['amount'],
                'method'     => $data['method'],
                'reference'  => $data['reference'] ?? null,
                'paid_at'    => now(),
                'received_by' => auth()->id(),
            ]);

            $paid = (float) $invoice->payments()->sum('amount');

            $invoice->update([
                'status' => $paid <= 0
                    ? 'unpaid'
                    : ($paid >= $invoice->total ? 'paid' : 'partial'),
            ]);

            return $payment;
        });
    }
}
