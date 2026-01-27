<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FinanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function __construct(private readonly FinanceService $finance)
    {
    }

    public function dashboard()
    {
        $summary = $this->finance->summary();

        // Map service summary into what the Blade expects
        $kpis = [
            'today' => (float) ($summary['today_total'] ?? 0),
            'week'  => (float) ($summary['week_total'] ?? 0),
            'month' => (float) ($summary['month_total'] ?? 0),
            'year'  => (float) ($summary['year_total'] ?? 0),
        ];

        // Build a simple 14-day revenue trend for the chart
        $start = now()->subDays(13)->startOfDay();

        $rows = DB::table('payments')
            ->selectRaw("date(paid_at) as day, sum(amount) as total")
            ->where('paid_at', '>=', $start)
            ->groupByRaw("date(paid_at)")
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $chartLabels = [];
        $chartValues = [];

        for ($i = 13; $i >= 0; $i--) {
            $d = now()->subDays($i)->toDateString();
            $chartLabels[] = $d;
            $chartValues[] = (float) ($rows[$d]->total ?? 0);
        }

        return view('admin.finance.dashboard', compact('kpis', 'chartLabels', 'chartValues'));
    }

    public function daily(Request $request)
    {
        $data = $this->finance->daily($request->get('date'));
        return view('admin.finance.reports-daily', $data);
    }

    public function weekly(Request $request)
    {
        $data = $this->finance->weekly($request->get('date'));
        return view('admin.finance.reports-weekly', $data);
    }

    public function monthly(Request $request)
    {
        $data = $this->finance->monthly($request->get('date'));
        return view('admin.finance.reports-monthly', $data);
    }

    public function yearly(Request $request)
    {
        $data = $this->finance->yearly($request->get('year'));
        return view('admin.finance.reports-yearly', $data);
    }
}
