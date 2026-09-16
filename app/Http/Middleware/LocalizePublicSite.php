<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class LocalizePublicSite
{
    private const SUPPORTED_LOCALES = ['ar', 'en'];

    private const DEFAULT_LOCALE = 'ar';

    /**
     * Matches any Arabic-script character left in an English response — a
     * sign that a Blade string or database field has no English counterpart.
     */
    private const ARABIC_CHAR_PATTERN = '/[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{08A0}-\x{08FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}]/u';

    /**
     * Apply the visitor's saved language and translate public HTML/JSON output.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', self::DEFAULT_LOCALE);

        if (! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = self::DEFAULT_LOCALE;
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

        if (method_exists($response, 'getContent')) {
            $content = $response->getContent();

            if (is_string($content)) {
                // Strip <script> blocks: source-level JS comments/strings aren't
                // rendered to the visitor, so they shouldn't trigger this check.
                $forCheck = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $content) ?? $content;

                if (preg_match(self::ARABIC_CHAR_PATTERN, $forCheck) === 1) {
                    Log::warning('Untranslated Arabic text served on the English site.', [
                        'url' => $request->fullUrl(),
                    ]);
                }
            }
        }

        return $response;
    }
}
