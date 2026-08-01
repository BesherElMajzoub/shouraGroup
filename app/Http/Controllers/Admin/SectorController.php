<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = Sector::withCount('brands')->orderBy('order')->get();
        return view('admin.sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sectors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validated($request);

        Sector::create($validated);

        return redirect()->route('admin.sectors.index')->with('success', 'تم إضافة القطاع بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        $validated = $this->validated($request, $sector);

        if ($request->hasFile('image') && $sector->image && ! str_starts_with($sector->image, 'images/')) {
            Storage::disk('public')->delete($sector->image);
        }

        $sector->update($validated);

        return redirect()->route('admin.sectors.index')->with('success', 'تم تحديث القطاع بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        if ($sector->image && ! str_starts_with($sector->image, 'images/')) {
            Storage::disk('public')->delete($sector->image);
        }

        $sector->delete();

        return redirect()->route('admin.sectors.index')->with('success', 'تم حذف القطاع بنجاح.');
    }

    /**
     * Shared validation and normalisation for store/update.
     *
     * Specialties are edited as one item per line and stored as a JSON array.
     */
    private function validated(Request $request, ?Sector $sector = null): array
    {
        $slugRule = 'unique:sectors,slug' . ($sector ? ',' . $sector->id : '');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'tagline' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_coming_soon' => ['boolean'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ]);

        // Str::slug() strips Arabic entirely, so fall back to a generated slug
        // rather than saving an empty one that would break the sector URL.
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name'])
            ?: ($sector->slug ?? 'sector-' . Str::lower(Str::random(6)));

        $validated['is_coming_soon'] = $request->has('is_coming_soon');
        $validated['is_active'] = $request->has('is_active');

        $validated['specialties'] = collect(preg_split('/\r\n|\r|\n/', $request->input('specialties', '')))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/sectors', 'public');
        } else {
            unset($validated['image']);
        }

        return $validated;
    }
}
