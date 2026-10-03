<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\News;
use App\Models\Sector;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAndFormHardeningTest extends TestCase
{
    use RefreshDatabase;

    private function newsPayload(Category $category, array $overrides = []): array
    {
        return array_merge([
            'category_id' => $category->id,
            'title_ar' => 'خبر',
            'title_en' => 'Same Title',
            'body_ar' => 'نص',
            'body_en' => 'Body',
            'order' => 0,
        ], $overrides);
    }

    public function test_admin_resources_without_a_show_page_have_no_show_route(): void
    {
        $this->assertFalse(\Route::has('admin.news.show'));
        $this->assertFalse(\Route::has('admin.sectors.show'));
        $this->assertTrue(\Route::has('admin.messages.show'));
    }

    public function test_duplicate_news_titles_get_unique_slugs(): void
    {
        $category = Category::create(['type' => 'news', 'name' => 'أخبار', 'name_en' => 'News', 'slug' => 'news', 'order' => 0]);
        $this->actingAs(User::factory()->create());

        $this->post(route('admin.news.store'), $this->newsPayload($category))->assertRedirect(route('admin.news.index'));
        $this->post(route('admin.news.store'), $this->newsPayload($category))->assertRedirect(route('admin.news.index'));

        $this->assertEqualsCanonicalizing(['same-title', 'same-title-2'], News::pluck('slug')->all());
    }

    public function test_contact_form_rejects_a_forged_department_email(): void
    {
        Setting::create(['key' => 'contact_email', 'value' => 'info@shora.test', 'group' => 'contact']);

        $payload = [
            'name' => 'Ali', 'phone' => '0999', 'department_name' => 'General',
            'subject' => 'Hi', 'message' => 'Hello',
        ];

        $this->postJson(route('contact.store'), $payload + ['department_email' => 'attacker@evil.test'])
            ->assertStatus(422)->assertJsonValidationErrors('department_email');

        $this->postJson(route('contact.store'), $payload + ['department_email' => 'info@shora.test'])
            ->assertOk();
    }

    public function test_contact_form_accepts_a_sector_inbox(): void
    {
        Sector::create(['name' => 'مضخات', 'name_en' => 'Pumps', 'slug' => 'pumps', 'email' => 'pumps@shora.test', 'is_active' => true, 'order' => 0]);

        $this->postJson(route('contact.store'), [
            'name' => 'Ali', 'phone' => '0999', 'department_name' => 'Pumps',
            'department_email' => 'pumps@shora.test', 'subject' => 'Hi', 'message' => 'Hello',
        ])->assertOk();
    }

    public function test_public_forms_are_rate_limited(): void
    {
        for ($i = 0; $i < 6; $i++) {
            $this->postJson(route('wholesale.store'), [])->assertStatus(422);
        }

        $this->postJson(route('wholesale.store'), [])->assertStatus(429);
    }
}
