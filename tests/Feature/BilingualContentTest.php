<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\News;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class BilingualContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_cms_settings_and_services_use_the_selected_locale_without_phrase_replacement(): void
    {
        Setting::create([
            'key' => 'about_subtitle',
            'value' => 'نص عربي جديد لا يوجد في قاموس ترجمة',
            'value_en' => 'A brand-new English CMS sentence',
            'group' => 'home',
        ]);

        Service::create([
            'title' => 'خدمة عربية جديدة',
            'title_en' => 'A Newly Added Service',
            'dept' => 'قسم عربي جديد',
            'dept_en' => 'A Newly Added Department',
            'description' => 'وصف عربي جديد',
            'description_en' => 'A newly added service description.',
            'group' => 'home',
            'order' => 1,
            'is_active' => true,
        ]);

        Cache::flush();

        $this->withSession(['locale' => 'en'])->get(route('home'))
            ->assertOk()
            ->assertSeeText('A brand-new English CMS sentence')
            ->assertSeeText('A Newly Added Service')
            ->assertSeeText('A newly added service description.')
            ->assertDontSeeText('نص عربي جديد لا يوجد في قاموس ترجمة')
            ->assertDontSeeText('خدمة عربية جديدة');

        $this->withSession(['locale' => 'ar'])->get(route('home'))
            ->assertOk()
            ->assertSeeText('نص عربي جديد لا يوجد في قاموس ترجمة')
            ->assertSeeText('خدمة عربية جديدة')
            ->assertDontSeeText('A brand-new English CMS sentence');
    }

    public function test_new_news_and_category_are_rendered_in_both_languages(): void
    {
        $category = Category::create([
            'type' => 'news',
            'name' => 'تصنيف عربي مخصص',
            'name_en' => 'Custom News Category',
            'slug' => 'custom-news',
            'order' => 1,
        ]);

        News::create([
            'category_id' => $category->id,
            'title_ar' => 'خبر عربي جديد كلياً',
            'title_en' => 'A Completely New Article',
            'slug' => 'a-completely-new-article',
            'excerpt_ar' => 'ملخص عربي جديد',
            'excerpt_en' => 'A new English summary.',
            'body_ar' => 'تفاصيل الخبر العربي',
            'body_en' => 'The complete English article.',
            'published_at' => now(),
            'is_published' => true,
            'order' => 1,
        ]);

        $this->withSession(['locale' => 'en'])->get(route('news'))
            ->assertOk()
            ->assertSeeText('Custom News Category')
            ->assertSeeText('A Completely New Article')
            ->assertSeeText('A new English summary.')
            ->assertDontSeeText('خبر عربي جديد كلياً');

        $this->withSession(['locale' => 'ar'])->get(route('news'))
            ->assertOk()
            ->assertSeeText('تصنيف عربي مخصص')
            ->assertSeeText('خبر عربي جديد كلياً');
    }

    public function test_admin_cannot_publish_a_service_without_english_content(): void
    {
        $response = $this->actingAs(User::factory()->create())->post(route('admin.services.store'), [
            'title' => 'خدمة بلا ترجمة',
            'dept' => 'قسم بلا ترجمة',
            'description' => 'وصف بلا ترجمة',
            'features_text' => "ميزة أولى\nميزة ثانية",
            'group' => 'home',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertSessionHasErrors([
            'title_en',
            'dept_en',
            'description_en',
            'features_text_en',
        ]);
        $this->assertDatabaseCount('services', 0);
    }

    public function test_admin_cannot_publish_news_without_english_content(): void
    {
        $category = Category::create([
            'type' => 'news',
            'name' => 'أخبار',
            'name_en' => 'News',
            'slug' => 'news',
            'order' => 1,
        ]);

        $response = $this->actingAs(User::factory()->create())->post(route('admin.news.store'), [
            'category_id' => $category->id,
            'title_ar' => 'خبر بلا ترجمة',
            'body_ar' => 'محتوى بلا ترجمة',
            'order' => 1,
            'is_published' => '1',
        ]);

        $response->assertSessionHasErrors(['title_en', 'body_en']);
        $this->assertDatabaseCount('news', 0);
    }
}
