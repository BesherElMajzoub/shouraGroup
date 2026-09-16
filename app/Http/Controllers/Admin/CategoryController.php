<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('type')->orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:project,news'],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']) ?: urlencode($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']) ?: urlencode($validated['slug']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'تم إضافة التصنيف بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:project,news'],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']) ?: urlencode($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']) ?: urlencode($validated['slug']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Prevent deletion if category has associated projects or news
        if ($category->projects()->count() > 0 || $category->news()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'لا يمكن حذف هذا التصنيف لوجود مشاريع أو أخبار مرتبطة به.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'تم حذف التصنيف بنجاح.');
    }
}
