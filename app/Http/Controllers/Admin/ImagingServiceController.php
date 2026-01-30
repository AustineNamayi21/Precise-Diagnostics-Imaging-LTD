<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagingServiceForVisitRequest;
use App\Http\Requests\Admin\UpdateImagingServiceRequest;
use App\Http\Requests\Admin\UpdateImagingServiceStatusRequest;
use App\Models\ImagingService;
use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImagingServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = ImagingService::query()
            ->with(['visit.patient', 'service', 'report'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', (int) $request->input('visit_id'));
        }

        $imagingServices = $query->paginate(20)->withQueryString();

        return view('admin.imaging-services.index', compact('imagingServices'));
    }

    /**
     * ✅ RESOURCE STORE (POST /admin/imaging-services)
     * Supports creating imaging service from a general form where visit_id is submitted.
     */
    public function store(StoreImagingServiceForVisitRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // requires visit_id in request for resource store mode
        $visitId = (int) ($data['visit_id'] ?? 0);
        if (!$visitId) {
            return back()->withErrors(['visit_id' => 'Visit is required.']);
        }

        $visit = Visit::findOrFail($visitId);

        $data['visit_id'] = $visit->id;
        $data['radiographer_id'] = auth()->id();
        $data['status'] = $data['status'] ?? 'ordered';

        ImagingService::create($data);

        return redirect()
            ->route('admin.visits.show', ['visit' => $visit->id])
            ->with('success', 'Imaging service added to visit successfully.');
    }

    /**
     * ✅ NESTED STORE (POST /admin/visits/{visit}/imaging-services)
     * This is what the Visit Details page uses.
     */
    public function storeForVisit(StoreImagingServiceForVisitRequest $request, Visit $visit): RedirectResponse
    {
        $data = $request->validated();

        $data['visit_id'] = $visit->id;
        $data['radiographer_id'] = auth()->id();
        $data['status'] = $data['status'] ?? 'ordered';

        ImagingService::create($data);

        return redirect()
            ->route('admin.visits.show', ['visit' => $visit->id])
            ->with('success', 'Imaging service added to visit successfully.');
    }

    public function show(ImagingService $imaging_service): View
    {
        $imaging_service->load(['visit.patient', 'service', 'report']);

        return view('admin.imaging-services.show', [
            'imagingService' => $imaging_service,
        ]);
    }

    public function edit(ImagingService $imaging_service): View
    {
        $imaging_service->load(['visit.patient', 'service']);

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('modality')
            ->orderBy('name')
            ->get();

        return view('admin.imaging-services.edit', [
            'imagingService' => $imaging_service,
            'services' => $services,
        ]);
    }

    public function update(UpdateImagingServiceRequest $request, ImagingService $imaging_service): RedirectResponse
    {
        $imaging_service->update($request->validated());

        return redirect()
            ->route('admin.imaging-services.show', ['imaging_service' => $imaging_service->id])
            ->with('success', 'Imaging service updated successfully.');
    }

    /**
     * ✅ RESOURCE destroy (DELETE /admin/imaging-services/{imaging_service})
     */
    public function destroy(ImagingService $imaging_service): RedirectResponse
    {
        $visit = $imaging_service->visit;
        $imaging_service->delete();

        if ($visit) {
            return redirect()
                ->route('admin.visits.show', ['visit' => $visit->id])
                ->with('success', 'Imaging service deleted successfully.');
        }

        return redirect()
            ->route('admin.imaging-services.index')
            ->with('success', 'Imaging service deleted successfully.');
    }

    /**
     * ✅ NESTED destroy (DELETE /admin/visits/{visit}/imaging-services/{imaging_service})
     */
    public function destroyForVisit(Visit $visit, ImagingService $imaging_service): RedirectResponse
    {
        $imaging_service->delete();

        return redirect()
            ->route('admin.visits.show', ['visit' => $visit->id])
            ->with('success', 'Imaging service deleted successfully.');
    }

    public function updateStatus(UpdateImagingServiceStatusRequest $request, ImagingService $imagingService): RedirectResponse
    {
        $validated = $request->validated();

        $imagingService->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
