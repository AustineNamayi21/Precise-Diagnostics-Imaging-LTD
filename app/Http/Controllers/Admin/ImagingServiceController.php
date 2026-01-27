<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImagingServiceForVisitRequest;
use App\Http\Requests\UpdateImagingServiceStatusRequest;
use App\Http\Requests\UpdateImagingServiceRequest;
use App\Models\ImagingService;
use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\Request;

class ImagingServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = ImagingService::query()
            ->with(['visit.patient', 'service', 'report'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        $imagingServices = $query->paginate(20)->withQueryString();

        return view('admin.imaging-services.index', compact('imagingServices'));
    }

    public function storeForVisit(StoreImagingServiceForVisitRequest $request, Visit $visit)
    {
        $data = $request->validated();

        $data['visit_id'] = $visit->id;
        $data['radiographer_id'] = auth()->id();
        $data['status'] = $data['status'] ?? 'ordered';

        ImagingService::create($data);

        return redirect()
            ->route('admin.visits.show', $visit)
            ->with('success', 'Imaging service added to visit successfully.');
    }

    public function show(ImagingService $imaging_service)
    {
        $imaging_service->load(['visit.patient', 'service', 'report']);

        return view('admin.imaging-services.show', [
            'imagingService' => $imaging_service
        ]);
    }

    public function edit(ImagingService $imaging_service)
    {
        $imaging_service->load(['visit.patient', 'service']);

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.imaging-services.edit', [
            'imagingService' => $imaging_service,
            'services' => $services,
        ]);
    }

    public function update(UpdateImagingServiceRequest $request, ImagingService $imaging_service)
    {
        $imaging_service->update($request->validated());

        return redirect()
            ->route('admin.imaging-services.show', $imaging_service)
            ->with('success', 'Imaging service updated successfully.');
    }

    public function destroy(ImagingService $imaging_service)
    {
        $visit = $imaging_service->visit; // ✅ get Visit instance for safe redirect
        $imaging_service->delete();

        return redirect()
            ->route('admin.visits.show', $visit)
            ->with('success', 'Imaging service deleted successfully.');
    }

    public function updateStatus(UpdateImagingServiceStatusRequest $request, ImagingService $imagingService)
    {
        $imagingService->update([
            'status' => $request->validated()['status']
        ]);

        return back()->with('success', 'Status updated successfully.');
    }
}
