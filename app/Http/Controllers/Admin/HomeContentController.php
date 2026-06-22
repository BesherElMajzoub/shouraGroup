<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    /**
     * Display settings form.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'about_body' => ['required', 'string'],
            'vision_text' => ['required', 'string'],
            'mission_text' => ['required', 'string'],
            'clients_intro' => ['required', 'string'],
            'story_overview_body' => ['required', 'string'],
            'story_overview_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $keys = ['about_body', 'vision_text', 'mission_text', 'clients_intro', 'story_overview_body'];

        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($key)]
            );
        }

        if ($request->hasFile('story_overview_image')) {
            // Delete old file if it exists and is not the seeded public image
            $oldSetting = Setting::where('key', 'story_overview_image')->first();
            if ($oldSetting && $oldSetting->value && !str_starts_with($oldSetting->value, 'images/')) {
                Storage::disk('public')->delete($oldSetting->value);
            }

            $path = $request->file('story_overview_image')->store('uploads/story', 'public');
            Setting::updateOrCreate(
                ['key' => 'story_overview_image'],
                ['value' => $path]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'تم تحديث الإعدادات والنصوص بنجاح.');
    }
}
