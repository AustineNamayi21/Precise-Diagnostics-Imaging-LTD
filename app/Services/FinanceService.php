<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinanceService
{
    public function summary(): array
    {
        $today = Carbon::today();

        return [
            'today_total' => $this->sumBetween($today->copy()->startOfDay(), $today->copy()->endOfDay()),
            'week_total'  => $this->sumBetween(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()),
            'month_total' => $this->sumBetween(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()),
            'year_total'  => $this->sumBetween(Carbon::now()->startOfYear(), Carbon::now()->endOfYear()),
        ];
    }

    public function daily(?string $date): array
    {
        $d = $date ? Carbon::parse($date) : Carbon::today();
        $start = $d->copy()->startOfDay();
        $end = $d->copy()->endOfDay();

        return [
            'date' => $d->toDateString(),
            'total' => $this->sumBetween($start, $end),
            'rows' => DB::table('payments')
                ->whereBetween('paid_at', [$start, $end])
                ->orderByDesc('paid_at')
                ->get(),
        ];
    }

    public function weekly(?string $date): array
    {
        $d = $date ? Carbon::parse($date) : Carbon::now();
        $start = $d->copy()->startOfWeek();
        $end = $d->copy()->endOfWeek();

        $byDay = DB::table('payments')
            ->selectRaw("date(paid_at) as day, sum(amount) as total")
            ->whereBetween('paid_at', [$start, $end])
            ->groupByRaw("date(paid_at)")
            ->orderBy('day')
            ->get();

        return [
            'week_start' => $start->toDateString(),
            'week_end' => $end->toDateString(),
            'total' => (float) $byDay->sum('total'),
            'by_day' => $byDay,
        ];
    }

    public function monthly(?string $date): array
    {
        $d = $date ? Carbon::parse($date) : Carbon::now();
        $start = $d->copy()->startOfMonth();
        $end = $d->copy()->endOfMonth();

        $byDay = DB::table('payments')
            ->selectRaw("date(paid_at) as day, sum(amount) as total")
            ->whereBetween('paid_at', [$start, $end])
            ->groupByRaw("date(paid_at)")
            ->orderBy('day')
            ->get();

        return [
            'month' => $d->format('Y-m'),
            'total' => (float) $byDay->sum('total'),
            'by_day' => $byDay,
        ];
    }

    public function yearly(?string $year): array
    {
        $y = $year ? (int) $year : (int) Carbon::now()->format('Y');
        $start = Carbon::createFromDate($y, 1, 1)->startOfDay();
        $end = Carbon::createFromDate($y, 12, 31)->endOfDay();

        $byMonth = DB::table('payments')
            ->selectRaw("strftime('%Y-%m', paid_at) as month, sum(amount) as total")
            ->whereBetween('paid_at', [$start, $end])
            ->groupByRaw("strftime('%Y-%m', paid_at)")
            ->orderBy('month')
            ->get();

        return [
            'year' => $y,
            'total' => (float) $byMonth->sum('total'),
            'by_month' => $byMonth,
        ];
    }

    private function sumBetween(Carbon $start, Carbon $end): float
    {
        return (float) DB::table('payments')
            ->whereBetween('paid_at', [$start, $end])
            ->sum('amount');
    }
}
