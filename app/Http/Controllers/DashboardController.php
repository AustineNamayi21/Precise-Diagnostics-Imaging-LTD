<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $notices = Notice::query()
            ->where('is_active', true)
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.dashboard', compact('notices'));
    }
}
