<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_switch_to_english_and_public_copy_is_translated(): void
    {
        $this->from('/about')
            ->get('/language/en')
            ->assertRedirect('/about')
            ->assertSessionHas('locale', 'en');

        $this->get('/')
            ->assertOk()
            ->assertSeeText('Home')
            ->assertDontSeeText('الرئيسية');
    }
}
