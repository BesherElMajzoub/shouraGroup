<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->withCount('images')->orderBy('order')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('type', 'project')->orderBy('order')->get();

        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated['is_active'] = $request->boolean('is_active');
        $validated['slug'] = $this->uniqueSlug($validated['title_ar'], $validated['slug'] ?? null);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/projects/covers', 'public');
        }

        $project = Project::create($this->projectData($validated));
        $this->storeNewGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'تمت إضافة المشروع بنجاح.');
    }

    public function edit(Project $project)
    {
        $project->load('images');
        $categories = Category::where('type', 'project')->orderBy('order')->get();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate($this->rules());
        $validated['is_active'] = $request->boolean('is_active');
        $validated['slug'] = $this->uniqueSlug($validated['title_ar'], $validated['slug'] ?? null, $project->id);

        if ($request->hasFile('image')) {
            $this->deleteUploadedFile($project->image);
            $validated['image'] = $request->file('image')->store('uploads/projects/covers', 'public');
        }

        $project->update($this->projectData($validated));
        $this->updateExistingGalleryImages($request, $project);
        $this->storeNewGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'تم تحديث المشروع بنجاح.');
    }

    public function destroy(Project $project)
    {
        $project->load('images');
        $this->deleteUploadedFile($project->image);

        foreach ($project->images as $image) {
            $this->deleteUploadedFile($image->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح.');
    }

    private function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'slug' => ['nullable', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'client_ar' => ['nullable', 'string', 'max:255'],
            'client_en' => ['nullable', 'string', 'max:255'],
            'location_ar' => ['nullable', 'string', 'max:255'],
            'location_en' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:100'],
            'status_ar' => ['nullable', 'string', 'max:255'],
            'status_en' => ['nullable', 'string', 'max:255'],
            'summary_ar' => ['nullable', 'string'],
            'summary_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'challenge_ar' => ['nullable', 'string'],
            'challenge_en' => ['nullable', 'string'],
            'solution_ar' => ['nullable', 'string'],
            'solution_en' => ['nullable', 'string'],
            'scope_ar' => ['nullable', 'string'],
            'scope_en' => ['nullable', 'string'],
            'equipment_ar' => ['nullable', 'string'],
            'equipment_en' => ['nullable', 'string'],
            'duration_ar' => ['nullable', 'string', 'max:255'],
            'duration_en' => ['nullable', 'string', 'max:255'],
            'results_ar' => ['nullable', 'string'],
            'results_en' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:7168'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'gallery_images' => ['nullable', 'array', 'max:30'],
            'gallery_images.*' => ['required', 'image', 'max:7168'],
            'gallery_caption_ar' => ['nullable', 'array'],
            'gallery_caption_ar.*' => ['nullable', 'string', 'max:1000'],
            'gallery_caption_en' => ['nullable', 'array'],
            'gallery_caption_en.*' => ['nullable', 'string', 'max:1000'],
            'gallery_order' => ['nullable', 'array'],
            'gallery_order.*' => ['nullable', 'integer', 'min:0'],
            'existing_caption_ar' => ['nullable', 'array'],
            'existing_caption_ar.*' => ['nullable', 'string', 'max:1000'],
            'existing_caption_en' => ['nullable', 'array'],
            'existing_caption_en.*' => ['nullable', 'string', 'max:1000'],
            'existing_order' => ['nullable', 'array'],
            'existing_order.*' => ['nullable', 'integer', 'min:0'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['nullable', 'boolean'],
        ];
    }

    private function projectData(array $validated): array
    {
        return collect($validated)->only((new Project)->getFillable())->all();
    }

    private function uniqueSlug(string $title, ?string $requested = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($requested ?: $title) ?: 'project';
        $slug = $base;
        $suffix = 2;

        while (Project::where('slug', $slug)->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    private function storeNewGalleryImages(Request $request, Project $project): void
    {
        foreach ($request->file('gallery_images', []) as $index => $file) {
            $project->images()->create([
                'image' => $file->store('uploads/projects/gallery', 'public'),
                'caption_ar' => $request->input("gallery_caption_ar.$index"),
                'caption_en' => $request->input("gallery_caption_en.$index"),
                'order' => $request->integer("gallery_order.$index", $index),
            ]);
        }
    }

    private function updateExistingGalleryImages(Request $request, Project $project): void
    {
        $images = $project->images()->get()->keyBy('id');

        foreach ($images as $id => $image) {
            if ($request->boolean("remove_gallery.$id")) {
                $this->deleteUploadedFile($image->image);
                $image->delete();

                continue;
            }

            $image->update([
                'caption_ar' => $request->input("existing_caption_ar.$id"),
                'caption_en' => $request->input("existing_caption_en.$id"),
                'order' => $request->integer("existing_order.$id", $image->order),
            ]);
        }
    }

    private function deleteUploadedFile(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/') && ! Str::startsWith($path, ['http://', 'https://'])) {
            Storage::disk('public')->delete($path);
        }
    }
}
