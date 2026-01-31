<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Services\BillingService;
use Illuminate\Http\RedirectResponse;

class BillingController extends Controller
{
    public function __construct(private BillingService $billingService)
    {
    }

    public function sync(Visit $visit): RedirectResponse
    {
        $this->billingService->syncInvoiceForVisit($visit);

        // ✅ IMPORTANT: redirect to the visit show page (GET-friendly)
        return redirect()
            ->route('admin.visits.show', $visit->id)
            ->with('success', 'Invoice synced successfully.');
    }
}
