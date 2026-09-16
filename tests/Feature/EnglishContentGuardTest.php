<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\News;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class EnglishContentGuardTest extends TestCase
{
    use RefreshDatabase;

    private const ARABIC_PATTERN = '/[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{08A0}-\x{08FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}]/u';

    public function test_public_english_pages_do_not_render_arabic_text(): void
    {
        Setting::create([
            'key' => 'story_overview_image',
            'value' => 'images/about_skyscrapers.png',
            'value_en' => 'images/about_skyscrapers.png',
            'group' => 'story',
        ]);

        foreach (['home', 'about', 'sectors', 'services', 'brands', 'projects', 'news', 'wholesale', 'careers', 'contact'] as $route) {
            $response = $this->withSession(['locale' => 'en'])->get(route($route));

            $response->assertOk();
            $this->assertNoVisibleArabic($response->getContent(), $route);
        }

        $notFound = $this->withSession(['locale' => 'en'])->get('/missing-english-page');
        $notFound->assertNotFound();
        $this->assertNoVisibleArabic($notFound->getContent(), '404');
    }

    public function test_english_models_never_fall_back_to_arabic_columns(): void
    {
        App::setLocale('en');

        $setting = Setting::create([
            'key' => 'strict_english_setting',
            'value' => 'قيمة عربية',
            'value_en' => null,
            'group' => 'test',
        ]);
        $service = Service::create([
            'title' => 'خدمة عربية',
            'dept' => 'قسم عربي',
            'description' => 'وصف عربي',
            'features' => ['ميزة عربية'],
            'group' => 'home',
            'order' => 1,
            'is_active' => true,
        ]);
        $category = Category::create([
            'type' => 'news',
            'name' => 'تصنيف عربي',
            'slug' => 'arabic-only',
            'order' => 1,
        ]);
        $news = News::create([
            'category_id' => $category->id,
            'title_ar' => 'عنوان عربي',
            'excerpt_ar' => 'ملخص عربي',
            'body_ar' => 'محتوى عربي',
            'slug' => 'arabic-only-news',
            'is_published' => true,
            'order' => 1,
        ]);
        $project = Project::create([
            'category_id' => $category->id,
            'title_ar' => 'مشروع عربي',
            'summary_ar' => 'نبذة عربية',
            'slug' => 'arabic-only-project',
            'order' => 1,
            'is_active' => true,
        ]);
        $image = new ProjectImage(['caption_ar' => 'وصف صورة عربي']);

        $this->assertNull($setting->value);
        $this->assertNull($service->title);
        $this->assertNull($service->description);
        $this->assertNull($service->features);
        $this->assertNull($category->name);
        $this->assertNull($news->title);
        $this->assertNull($news->excerpt);
        $this->assertNull($news->body);
        $this->assertNull($project->title);
        $this->assertNull($project->summary);
        $this->assertNull($image->caption);
    }

    public function test_admin_rejects_arabic_characters_in_english_fields(): void
    {
        $response = $this->actingAs(User::factory()->create())->post(route('admin.services.store'), [
            'title' => 'خدمة اختبار',
            'title_en' => 'English خدمة',
            'dept' => 'قسم اختبار',
            'dept_en' => 'English Department',
            'description' => 'وصف اختبار',
            'description_en' => 'English description',
            'group' => 'home',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertSessionHasErrors('title_en');
        $this->assertDatabaseCount('services', 0);
    }

    public function test_english_validation_errors_use_human_readable_field_names(): void
    {
        $this->withSession(['locale' => 'en'])
            ->postJson(route('careers.store'), [])
            ->assertUnprocessable()
            ->assertJsonPath('errors.full_name.0', 'The full name field is required.')
            ->assertJsonPath('errors.cv.0', 'The CV field is required.');
    }

    private function assertNoVisibleArabic(string $html, string $page): void
    {
        $visible = preg_replace('#<(script|style)\b[^>]*>.*?</\1>#is', '', $html) ?? $html;
        $visible = preg_replace('/<!--.*?-->/s', '', $visible) ?? $visible;
        $visible = html_entity_decode(strip_tags($visible), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        preg_match('/.{0,60}[\x{0600}-\x{06FF}].{0,60}/u', $visible, $snippet);

        $this->assertDoesNotMatchRegularExpression(
            self::ARABIC_PATTERN,
            $visible,
            "Arabic text was rendered on the English {$page} page: ".($snippet[0] ?? 'unknown text')
        );
    }
}
