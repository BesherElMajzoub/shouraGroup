<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
