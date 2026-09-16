<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('sectors')->orderBy('order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create', ['sectors' => $this->sectors()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        [$validated, $sectorIds] = $this->validated($request);

        $brand = Brand::create($validated);
        $brand->sectors()->sync($sectorIds);

        return redirect()->route('admin.brands.index')->with('success', 'تم إضافة العلامة التجارية بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', [
            'brand' => $brand,
            'sectors' => $this->sectors(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        [$validated, $sectorIds] = $this->validated($request, $brand);

        if ($request->hasFile('logo') && $brand->logo && ! str_starts_with($brand->logo, 'images/')) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->update($validated);
        $brand->sectors()->sync($sectorIds);

        return redirect()->route('admin.brands.index')->with('success', 'تم تحديث العلامة التجارية بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->logo && ! str_starts_with($brand->logo, 'images/')) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'تم حذف العلامة التجارية بنجاح.');
    }

    private function sectors()
    {
        return Sector::orderBy('order')->get();
    }

    /**
     * @return array{0: array, 1: array} validated attributes and the selected sector ids
     */
    private function validated(Request $request, ?Brand $brand = null): array
    {
        $slugRule = 'unique:brands,slug' . ($brand ? ',' . $brand->id : '');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'country' => ['nullable', 'string', 'max:100'],
            'country_en' => ['required_with:country', 'nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'description_en' => ['required_with:description', 'nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:7168'],
            'is_agency' => ['boolean'],
            'show_on_home' => ['boolean'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
            'sectors' => ['nullable', 'array'],
            'sectors.*' => ['integer', 'exists:sectors,id'],
        ]);

        $sectorIds = $validated['sectors'] ?? [];
        unset($validated['sectors']);

        // Brand names are latin, so Str::slug() normally succeeds; keep a fallback anyway.
        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['name'])
            ?: ($brand->slug ?? 'brand-' . Str::lower(Str::random(6)));

        $validated['is_agency'] = $request->has('is_agency');
        $validated['show_on_home'] = $request->has('show_on_home');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/brands', 'public');
        } else {
            unset($validated['logo']);
        }

        return [$validated, $sectorIds];
    }
}
