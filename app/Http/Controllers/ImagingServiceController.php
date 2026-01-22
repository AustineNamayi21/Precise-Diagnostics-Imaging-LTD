<?php

namespace App\Http\Controllers;

use App\Models\ImagingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImagingServiceController extends Controller
{
    public function index()
    {
        $services = ImagingService::latest()->paginate(20);
        return view('imaging-services.index', compact('services'));
    }

    public function create()
    {
        return view('imaging-services.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_code' => 'required|string|unique:imaging_services',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'modality' => 'required|in:xray,ct,mri,ultrasound,mammography,fluoroscopy',
            'body_part' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'preparation_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ImagingService::create($request->all());

        return redirect()->route('imaging-services.index')
            ->with('success', 'Imaging service created successfully.');
    }

    public function show(ImagingService $imagingService)
    {
        return view('imaging-services.show', compact('imagingService'));
    }

    public function edit(ImagingService $imagingService)
    {
        return view('imaging-services.edit', compact('imagingService'));
    }

    public function update(Request $request, ImagingService $imagingService)
    {
        $validator = Validator::make($request->all(), [
            'service_code' => 'required|string|unique:imaging_services,service_code,' . $imagingService->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'modality' => 'required|in:xray,ct,mri,ultrasound,mammography,fluoroscopy',
            'body_part' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'preparation_instructions' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagingService->update($request->all());

        return redirect()->route('imaging-services.show', $imagingService)
            ->with('success', 'Imaging service updated successfully.');
    }

    public function destroy(ImagingService $imagingService)
    {
        $imagingService->delete();

        return redirect()->route('imaging-services.index')
            ->with('success', 'Imaging service deleted successfully.');
    }
}