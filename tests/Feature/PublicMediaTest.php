<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_serves_a_file_from_the_public_disk(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('uploads/news/example.jpg', 'image-content');

        $response = $this->get('/media/uploads/news/example.jpg');

        $response
            ->assertOk()
            ->assertHeader('Cache-Control', 'immutable, max-age=31536000, public')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
    }

    public function test_it_returns_not_found_for_a_missing_file(): void
    {
        Storage::fake('public');

        $this->get('/media/uploads/news/missing.jpg')->assertNotFound();
    }
}
