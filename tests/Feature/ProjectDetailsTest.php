<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectDetailsTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_cards_open_the_detail_page_instead_of_contact(): void
    {
        $project = $this->project();

        $this->get(route('projects'))
            ->assertOk()
            ->assertSee(route('projects.show', $project->slug), false)
            ->assertDontSee('/contact?project=', false);
    }

    public function test_active_project_detail_displays_localized_content_and_ordered_gallery(): void
    {
        Storage::fake('public');
        $project = $this->project();
        $project->images()->createMany([
            ['image' => 'uploads/projects/gallery/second.jpg', 'caption_ar' => 'الصورة الثانية', 'caption_en' => 'Second image', 'order' => 2],
            ['image' => 'uploads/projects/gallery/first.jpg', 'caption_ar' => 'الصورة الأولى', 'caption_en' => 'First image', 'order' => 1],
        ]);

        $this->get(route('projects.show', $project->slug))
            ->assertOk()
            ->assertSee('مشروع محطة المياه')
            ->assertSeeInOrder(['الصورة الأولى', 'الصورة الثانية'])
            ->assertDontSee('تواصل معنا');

        $this->withSession(['locale' => 'en'])
            ->get(route('projects.show', $project->slug))
            ->assertOk()
            ->assertSee('Water Station Project')
            ->assertSeeInOrder(['First image', 'Second image']);
    }

    public function test_admin_can_create_a_bilingual_project_with_a_cover_and_gallery(): void
    {
        Storage::fake('public');
        $category = Category::create(['type' => 'project', 'name' => 'الطاقة', 'slug' => 'energy', 'order' => 1]);

        $response = $this->actingAs(User::factory()->create())->post(route('admin.projects.store'), [
            'category_id' => $category->id,
            'title_ar' => 'مشروع طاقة جديد',
            'title_en' => 'New Energy Project',
            'client_ar' => 'العميل العربي',
            'client_en' => 'English Client',
            'location_ar' => 'دمشق',
            'location_en' => 'Damascus',
            'year' => '2026',
            'status_ar' => 'مكتمل',
            'status_en' => 'Completed',
            'summary_ar' => 'نبذة عربية',
            'summary_en' => 'English summary',
            'description_ar' => 'وصف عربي دقيق',
            'description_en' => 'Detailed English description',
            'order' => 1,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('cover.jpg'),
            'gallery_images' => [UploadedFile::fake()->image('site.jpg')],
            'gallery_caption_ar' => ['من موقع التنفيذ'],
            'gallery_caption_en' => ['From the project site'],
            'gallery_order' => [3],
        ]);

        $response->assertRedirect(route('admin.projects.index'));

        $project = Project::where('title_ar', 'مشروع طاقة جديد')->with('images')->firstOrFail();
        $this->assertSame('New Energy Project', $project->title_en);
        $this->assertCount(1, $project->images);
        $this->assertSame('من موقع التنفيذ', $project->images->first()->caption_ar);
        $this->assertSame(3, $project->images->first()->order);
        Storage::disk('public')->assertExists($project->image);
        Storage::disk('public')->assertExists($project->images->first()->image);
    }

    public function test_admin_can_reorder_edit_and_delete_gallery_images(): void
    {
        Storage::fake('public');
        $project = $this->project();
        $kept = $project->images()->create([
            'image' => 'uploads/projects/gallery/kept.jpg',
            'caption_ar' => 'وصف قديم',
            'caption_en' => 'Old caption',
            'order' => 5,
        ]);
        $removed = $project->images()->create([
            'image' => 'uploads/projects/gallery/removed.jpg',
            'order' => 6,
        ]);
        Storage::disk('public')->put($kept->image, 'image');
        Storage::disk('public')->put($removed->image, 'image');

        $this->actingAs(User::factory()->create())->put(route('admin.projects.update', $project), [
            'category_id' => $project->category_id,
            'slug' => $project->slug,
            'title_ar' => $project->title_ar,
            'title_en' => $project->title_en,
            'year' => $project->year,
            'order' => $project->order,
            'is_active' => '1',
            'existing_caption_ar' => [$kept->id => 'وصف محدّث'],
            'existing_caption_en' => [$kept->id => 'Updated caption'],
            'existing_order' => [$kept->id => 1],
            'remove_gallery' => [$removed->id => '1'],
        ])->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('project_images', [
            'id' => $kept->id,
            'caption_ar' => 'وصف محدّث',
            'caption_en' => 'Updated caption',
            'order' => 1,
        ]);
        $this->assertDatabaseMissing('project_images', ['id' => $removed->id]);
        Storage::disk('public')->assertMissing($removed->image);
    }

    public function test_inactive_project_detail_returns_not_found(): void
    {
        $project = $this->project(['is_active' => false]);

        $this->get(route('projects.show', $project->slug))->assertNotFound();
    }

    private function project(array $overrides = []): Project
    {
        $category = Category::create([
            'type' => 'project',
            'name' => 'مضخات المياه',
            'slug' => 'water-pumps',
            'order' => 1,
        ]);

        return Project::create(array_merge([
            'category_id' => $category->id,
            'slug' => 'water-station-project',
            'title_ar' => 'مشروع محطة المياه',
            'title_en' => 'Water Station Project',
            'client_ar' => 'مؤسسة المياه',
            'client_en' => 'Water Authority',
            'location_ar' => 'دمشق',
            'location_en' => 'Damascus',
            'year' => '2026',
            'status_ar' => 'مكتمل',
            'status_en' => 'Completed',
            'summary_ar' => 'نبذة المشروع',
            'summary_en' => 'Project summary',
            'description_ar' => 'تفاصيل المشروع',
            'description_en' => 'Project details',
            'image' => 'images/industrial_bg.png',
            'order' => 1,
            'is_active' => true,
        ], $overrides));
    }
}
