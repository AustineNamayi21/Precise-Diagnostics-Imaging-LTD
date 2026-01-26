<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FinanceService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function __construct(private readonly FinanceService $finance)
    {
    }

    public function dashboard()
    {
        $summary = $this->finance->summary();

        return view('admin.finance.dashboard', compact('summary'));
    }

    public function daily(Request $request)
    {
        $data = $this->finance->daily($request->get('date'));
        return view('admin.finance.daily', $data);
    }

    public function weekly(Request $request)
    {
        $data = $this->finance->weekly($request->get('date'));
        return view('admin.finance.weekly', $data);
    }

    public function monthly(Request $request)
    {
        $data = $this->finance->monthly($request->get('date'));
        return view('admin.finance.monthly', $data);
    }

    public function yearly(Request $request)
    {
        $data = $this->finance->yearly($request->get('year'));
        return view('admin.finance.yearly', $data);
    }
}
