<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PublicMediaController extends Controller
{
    /**
     * Serve public uploads without relying on a web-server symlink.
     */
    public function __invoke(string $path): BinaryFileResponse
    {
        abort_if(
            $path === ''
            || str_contains($path, '..')
            || str_contains($path, '\\')
            || str_contains($path, "\0"),
            404
        );

        $disk = Storage::disk('public');

        abort_unless($disk->exists($path), 404);

        return response()->file($disk->path($path), [
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
