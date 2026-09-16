<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceWhatsappTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_configure_a_whatsapp_number_for_each_service(): void
    {
        $response = $this->actingAs(User::factory()->create())->post(route('admin.services.store'), [
            'title' => 'خدمة الصيانة',
            'title_en' => 'Maintenance Service',
            'dept' => 'قسم الصيانة',
            'dept_en' => 'Maintenance Department',
            'whatsapp' => '+963 932 555 111',
            'group' => 'pillar',
            'description' => 'خدمة صيانة متكاملة',
            'description_en' => 'A complete maintenance service',
            'order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'title' => 'خدمة الصيانة',
            'whatsapp' => '+963 932 555 111',
        ]);
    }

    public function test_services_page_shows_the_service_whatsapp_button_and_prefilled_message(): void
    {
        Service::create([
            'title' => 'خدمة الصيانة',
            'title_en' => 'Maintenance Service',
            'dept' => 'قسم الصيانة',
            'dept_en' => 'Maintenance Department',
            'whatsapp' => '+963 932 555 111',
            'description' => 'خدمة صيانة متكاملة',
            'description_en' => 'A complete maintenance service',
            'group' => 'pillar',
            'order' => 1,
            'is_active' => true,
        ]);

        $this->withSession(['locale' => 'ar'])
            ->get(route('services'))
            ->assertOk()
            ->assertSee('https://wa.me/963932555111', false)
            ->assertSeeText('راسلنا عبر واتساب')
            ->assertDontSeeText('اطلب الخدمة الآن');
    }
}
