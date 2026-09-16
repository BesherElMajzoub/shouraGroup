<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::orderBy('order')->get();
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Branch::create($this->validated($request));

        return redirect()->route('admin.branches.index')->with('success', 'تم إضافة الفرع بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update($this->validated($request));

        return redirect()->route('admin.branches.index')->with('success', 'تم تحديث الفرع بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'تم حذف الفرع بنجاح.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'city_en' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'address_en' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'description_en' => ['required_with:description', 'nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'mobile' => ['nullable', 'string', 'max:50'],
            // موضع الدبوس على خريطة سوريا بالنسبة المئوية
            'map_top' => ['required', 'numeric', 'min:0', 'max:100'],
            'map_left' => ['required', 'numeric', 'min:0', 'max:100'],
            'map_embed' => ['nullable', 'url', 'max:1000'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        return $validated;
    }
}
