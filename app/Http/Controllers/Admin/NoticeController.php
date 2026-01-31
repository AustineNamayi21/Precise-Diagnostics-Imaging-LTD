<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(): RedirectResponse
    {
        // We manage notices directly on the dashboard
        return redirect()->route('admin.dashboard');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'level' => ['required', 'in:info,success,warning,danger'],
            'is_pinned' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['created_by'] = auth()->id();

        Notice::create($data);

        return back()->with('success', 'Notice posted successfully.');
    }

    public function update(Request $request, Notice $notice): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'level' => ['required', 'in:info,success,warning,danger'],
            'is_pinned' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        $data['is_pinned'] = $request->boolean('is_pinned');
        $data['is_active'] = $request->boolean('is_active', true);

        $notice->update($data);

        return back()->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        return back()->with('success', 'Notice deleted.');
    }
}
