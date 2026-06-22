<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->orderBy('order')->orderByDesc('published_at')->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'news')->orderBy('order')->get();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
            'order' => ['required', 'integer'],
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']) ?: urlencode($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']) ?: urlencode($validated['slug']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/news', 'public');
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'تم إضافة الخبر بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::where('type', 'news')->orderBy('order')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
            'order' => ['required', 'integer'],
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']) ?: urlencode($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']) ?: urlencode($validated['slug']);
        }

        if ($request->hasFile('image')) {
            if ($news->image && !str_starts_with($news->image, 'images/')) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'تم تحديث الخبر بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->image && !str_starts_with($news->image, 'images/')) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'تم حذف الخبر بنجاح.');
    }
}
