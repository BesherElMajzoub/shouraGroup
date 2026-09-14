<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    /**
     * Text settings editable from the admin panel, grouped by the page they belong to.
     */
    private const TEXT_KEYS = [
        // الصفحة الرئيسية
        'about_subtitle', 'about_body', 'vision_text', 'mission_text', 'partners_intro', 'clients_intro',
        // من نحن
        'story_overview_body',
        // نصوص الصفحات الداخلية
        'sectors_intro', 'services_intro', 'brands_intro', 'projects_intro',
        'wholesale_intro', 'careers_intro', 'contact_intro',
        // بيانات التواصل
        'contact_email', 'sales_email', 'hr_email', 'phone_main', 'wholesale_whatsapp', 'working_hours',
    ];

    /**
     * Image settings and their storage directories.
     */
    private const IMAGE_FIELDS = [
        'home_about_main_image' => ['directory' => 'uploads/home/about', 'group' => 'home'],
        'home_about_secondary_image' => ['directory' => 'uploads/home/about', 'group' => 'home'],
        'home_about_logo' => ['directory' => 'uploads/home/about', 'group' => 'home'],
        'story_overview_image' => ['directory' => 'uploads/story', 'group' => 'story'],
    ];

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
            'about_subtitle' => ['required', 'string', 'max:255'],
            'about_body' => ['required', 'string'],
            'home_about_main_image' => ['nullable', 'image', 'max:2048'],
            'home_about_secondary_image' => ['nullable', 'image', 'max:2048'],
            'home_about_logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'vision_text' => ['required', 'string'],
            'mission_text' => ['required', 'string'],
            'partners_intro' => ['required', 'string'],
            'clients_intro' => ['required', 'string'],
            'story_overview_body' => ['required', 'string'],
            'story_overview_image' => ['nullable', 'image', 'max:2048'],

            'sectors_intro' => ['required', 'string'],
            'services_intro' => ['required', 'string'],
            'brands_intro' => ['required', 'string'],
            'projects_intro' => ['required', 'string'],
            'wholesale_intro' => ['required', 'string'],
            'careers_intro' => ['required', 'string'],
            'contact_intro' => ['required', 'string'],

            'contact_email' => ['required', 'email', 'max:255'],
            'sales_email' => ['required', 'email', 'max:255'],
            'hr_email' => ['required', 'email', 'max:255'],
            'phone_main' => ['required', 'string', 'max:50'],
            'wholesale_whatsapp' => ['nullable', 'string', 'max:30'],
            'working_hours' => ['required', 'string', 'max:255'],
        ]);

        foreach (self::TEXT_KEYS as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
        }

        foreach (self::IMAGE_FIELDS as $key => $config) {
            if (! $request->hasFile($key)) {
                continue;
            }

            $oldPath = Setting::where('key', $key)->value('value');
            $path = $request->file($key)->store($config['directory'], 'public');

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $path, 'group' => $config['group']],
            );

            // Seeded images live under public/images and must not be deleted.
            if ($oldPath && ! str_starts_with($oldPath, 'images/')) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // setting() caches forever, so the edited values need their entries dropped.
        foreach ([...self::TEXT_KEYS, ...array_keys(self::IMAGE_FIELDS)] as $key) {
            Cache::forget("setting.{$key}");
        }

        return redirect()->route('admin.settings.index')->with('success', 'تم تحديث الإعدادات والنصوص بنجاح.');
    }
}
