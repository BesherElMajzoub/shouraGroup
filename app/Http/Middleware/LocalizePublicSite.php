<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class LocalizePublicSite
{
    private const SUPPORTED_LOCALES = ['ar', 'en'];

    /**
     * Apply the visitor's saved language and translate public HTML/JSON output.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'ar');

        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = 'ar';
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);

        $response = $next($request);

        if ($locale !== 'en' || $request->is('admin*') || $response instanceof BinaryFileResponse) {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type');

        if ($contentType !== ''
            && ! str_contains($contentType, 'text/html')
            && ! str_contains($contentType, 'application/json')) {
            return $response;
        }

        $translations = trans('site');

        if (is_array($translations) && method_exists($response, 'getContent')) {
            $content = $response->getContent();

            if (is_string($content)) {
                $response->setContent(strtr($content, $translations));
            }
        }

        return $response;
    }
}
