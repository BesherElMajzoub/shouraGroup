<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    private const DEFAULT_ICON = 'M11.4 2.6a5 5 0 0 0 6 6L21 12l-2 2-3.4-3.4a5 5 0 0 1-6-6L7 1l4.4 1.6ZM3 17l6-6M3 17l3 3 6-6';

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
            'title_en' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'dept_en' => ['required', 'string', 'max:255'],
            'group' => ['required', 'in:home,pillar'],
            'description' => ['nullable', 'string'],
            'description_en' => ['required_with:description', 'nullable', 'string'],
            'image' => ['nullable', 'image', 'max:7168'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
            'features_text' => ['nullable', 'string'],
            'features_text_en' => ['required_with:features_text', 'nullable', 'string'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = self::DEFAULT_ICON;
        
        // Parse features line-by-line
        $features = [];
        if ($request->filled('features_text')) {
            $features = array_filter(array_map('trim', explode("\n", $request->input('features_text'))));
        }
        $validated['features'] = array_values($features);
        $validated['features_en'] = $this->lines($request->input('features_text_en', ''));
        unset($validated['features_text'], $validated['features_text_en']);

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
        $features_text = is_array($service->getRawOriginal('features'))
            ? implode("\n", $service->getRawOriginal('features'))
            : implode("\n", json_decode($service->getRawOriginal('features') ?: '[]', true) ?: []);
        $features_text_en = is_array($service->features_en) ? implode("\n", $service->features_en) : '';
        return view('admin.services.edit', compact('service', 'features_text', 'features_text_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'dept_en' => ['required', 'string', 'max:255'],
            'group' => ['required', 'in:home,pillar'],
            'description' => ['nullable', 'string'],
            'description_en' => ['required_with:description', 'nullable', 'string'],
            'image' => ['nullable', 'image', 'max:7168'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
            'features_text' => ['nullable', 'string'],
            'features_text_en' => ['required_with:features_text', 'nullable', 'string'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Parse features line-by-line
        $features = [];
        if ($request->filled('features_text')) {
            $features = array_filter(array_map('trim', explode("\n", $request->input('features_text'))));
        }
        $validated['features'] = array_values($features);
        $validated['features_en'] = $this->lines($request->input('features_text_en', ''));
        unset($validated['features_text'], $validated['features_text_en']);

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

    /**
     * ConvertEmptyStringsToNull turns a blank textarea into null, so the
     * parameter has to accept it rather than trusting the input() default.
     */
    private function lines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
