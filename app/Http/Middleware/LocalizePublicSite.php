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
     * Matches any Arabic-script character left in the response after the
     * site.php dictionary swap — a sign that some string (a Blade edit or
     * a database field) has no English counterpart registered.
     */
    private const ARABIC_CHAR_PATTERN = '/[\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{08A0}-\x{08FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}]/u';

    /**
     * The language-switch link intentionally names the *other* language in
     * its own script (e.g. "العربية" on the English site), so it must not
     * trip the untranslated-content check below.
     */
    private const EXPECTED_ARABIC_KEYS = ['ui.lang_switch.short', 'ui.lang_switch.full', 'ui.lang_switch.aria'];

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

        $translations = trans('site');

        if (is_array($translations) && method_exists($response, 'getContent')) {
            $content = $response->getContent();

            if (is_string($content)) {
                $translated = strtr($content, $translations);
                $response->setContent($translated);

                // Longest first: "aria" fully contains "short"/"full" ('العربية'), and
                // str_replace() applies needles in order, so a short match first would
                // leave a partial, still-Arabic remainder behind.
                $expectedArabic = array_filter(array_map('trans', self::EXPECTED_ARABIC_KEYS));
                usort($expectedArabic, fn ($a, $b) => mb_strlen($b) <=> mb_strlen($a));
                $forCheck = str_replace($expectedArabic, '', $translated);

                // Strip <script> blocks: source-level JS comments/strings aren't
                // rendered to the visitor, so they shouldn't trigger this check.
                $forCheck = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $forCheck) ?? $forCheck;

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
