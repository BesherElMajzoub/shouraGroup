<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'group' => ['required', 'in:home,pillar'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'], // SVG Path
            'image' => ['nullable', 'image', 'max:2048'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
            'features_text' => ['nullable', 'string'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        // Parse features line-by-line
        $features = [];
        if ($request->filled('features_text')) {
            $features = array_filter(array_map('trim', explode("\n", $request->input('features_text'))));
        }
        $validated['features'] = array_values($features);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        // Convert features array to double-newline or newline separated text for textarea
        $features_text = is_array($service->features) ? implode("\n", $service->features) : '';
        return view('admin.services.edit', compact('service', 'features_text'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'group' => ['required', 'in:home,pillar'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'], // SVG Path
            'image' => ['nullable', 'image', 'max:2048'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
            'features_text' => ['nullable', 'string'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Parse features line-by-line
        $features = [];
        if ($request->filled('features_text')) {
            $features = array_filter(array_map('trim', explode("\n", $request->input('features_text'))));
        }
        $validated['features'] = array_values($features);

        if ($request->hasFile('image')) {
            // Delete old file if it exists and is not the seeded public image
            if ($service->image && !str_starts_with($service->image, 'images/')) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'تم تحديث الخدمة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete image file if it is not seeded public image
        if ($service->image && !str_starts_with($service->image, 'images/')) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح.');
    }
}
