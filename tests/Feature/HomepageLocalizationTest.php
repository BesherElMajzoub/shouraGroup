<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomepageLocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_english_homepage_translates_copy_and_service_request_links(): void
    {
        $service = Service::create([
            'title' => 'تركيب وتسليم مجموعات التوليد الكهربائية',
            'title_en' => 'Custom Generator Installation',
            'dept' => 'قسم مجموعات التوليد والطاقة',
            'dept_en' => 'Custom Energy Department',
            'group' => 'home',
            'description' => 'توريد وتركيب وتشغيل مجموعات التوليد الكهربائية باستطاعات من 20 وحتى 2000 KVA، مع لوحات النقل الآلي والكبائن العازلة للصوت.',
            'description_en' => 'A newly authored English service description.',
            'order' => 1,
            'is_active' => true,
        ]);

        $englishUrl = url('/contact').'?service='.
            urlencode('Custom Generator Installation').
            '&department='.
            urlencode('Custom Energy Department');

        $response = $this->withSession(['locale' => 'en'])->get(route('home'));

        $response
            ->assertOk()
            ->assertSee('<html lang="en" dir="ltr">', false)
            ->assertSeeText('A Legacy of Trust and Engineering Excellence')
            ->assertSeeText('Explore Our Sectors')
            ->assertSee($englishUrl, false)
            ->assertSeeText('A newly authored English service description.')
            ->assertDontSeeText('تركيب وتسليم مجموعات التوليد الكهربائية');
    }

    public function test_arabic_homepage_keeps_arabic_service_request_values(): void
    {
        $service = Service::create([
            'title' => 'تركيب وتسليم مجموعات التوليد الكهربائية',
            'title_en' => 'Custom Generator Installation',
            'dept' => 'قسم مجموعات التوليد والطاقة',
            'dept_en' => 'Custom Energy Department',
            'group' => 'home',
            'order' => 1,
            'is_active' => true,
        ]);

        $this->withSession(['locale' => 'ar'])
            ->get(route('home'))
            ->assertOk()
            ->assertSee('<html lang="ar" dir="rtl">', false)
            ->assertSee(urlencode($service->title), false);
    }

    public function test_english_homepage_uses_the_shared_current_about_images(): void
    {
        Storage::fake('public');
        Cache::forever('setting.home_about_main_image.en', 'uploads/home/about/stale-english-image.jpg');

        foreach ([
            'home_about_main_image' => 'uploads/home/about/main-current.jpg',
            'home_about_secondary_image' => 'uploads/home/about/secondary-current.jpg',
            'home_about_logo' => 'uploads/home/about/logo-current.png',
        ] as $key => $path) {
            Storage::disk('public')->put($path, 'image-content');

            Setting::create([
                'key' => $key,
                'value' => $path,
                'value_en' => null,
                'group' => 'home',
            ]);
        }

        $response = $this->withSession(['locale' => 'en'])->get(route('home'));

        $response
            ->assertOk()
            ->assertSee('/media/uploads/home/about/main-current.jpg', false)
            ->assertSee('/media/uploads/home/about/secondary-current.jpg', false)
            ->assertSee('/media/uploads/home/about/logo-current.png', false)
            ->assertDontSee('/media/uploads/home/about/stale-english-image.jpg', false)
            ->assertSee('generators-128.webp 128w', false)
            ->assertSee('sizes="(max-width: 639px) 72px, 104px"', false);
    }
}
