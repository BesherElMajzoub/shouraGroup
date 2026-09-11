<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    public function test_visitor_can_switch_to_english_and_public_copy_is_translated(): void
    {
        Route::middleware('web')->get('/_locale-probe', fn () => response('الرئيسية'));

        $this->from('/about')
            ->get('/language/en')
            ->assertRedirect('/about')
            ->assertSessionHas('locale', 'en');

        $this->get('/_locale-probe')
            ->assertOk()
            ->assertSeeText('Home')
            ->assertDontSeeText('الرئيسية');
    }
}
