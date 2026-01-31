<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\BillingService;
use Illuminate\Http\Request;

class InvoicePaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice, BillingService $billing)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'method' => 'required|string',
        ]);

        $billing->recordPayment($invoice, $request->all());

        return back()->with('success', 'Payment recorded successfully.');
    }
}
