<?php
/**
 * Shora Group — Server compatibility check.
 *
 * Upload ONLY this file to the web root first, open it in the browser with the
 * token below, and it reports whether the server can run the application.
 *
 *     https://your-domain.com/server-check.php?token=CHANGE_ME_BEFORE_UPLOAD
 *
 * DELETE THIS FILE once you have read the report.
 */

$token = 'CHANGE_ME_BEFORE_UPLOAD';

if (! hash_equals($token, $_GET['token'] ?? '')) {
    http_response_code(404);
    exit('Not Found');
}

header('Content-Type: text/plain; charset=utf-8');

$pass = [];
$fail = [];
$warn = [];

// --- PHP version -----------------------------------------------------------
$php = PHP_VERSION;
version_compare($php, '8.3.0', '>=')
    ? $pass[] = "PHP {$php} (>= 8.3 required)"
    : $fail[] = "PHP {$php} is too old — Laravel 13 requires PHP 8.3 or newer";

// --- Required extensions ---------------------------------------------------
$required = [
    'pdo_mysql' => 'MySQL database driver',
    'mbstring'  => 'multi-byte strings (Arabic text)',
    'openssl'   => 'encryption / APP_KEY',
    'tokenizer' => 'Blade compilation',
    'xml'       => 'XML parsing',
    'ctype'     => 'character checks',
    'json'      => 'JSON encoding',
    'fileinfo'  => 'uploaded file MIME detection',
    'curl'      => 'outbound HTTP',
    'zip'       => 'archive handling',
];

foreach ($required as $ext => $why) {
    extension_loaded($ext)
        ? $pass[] = "ext-{$ext} — {$why}"
        : $fail[] = "ext-{$ext} MISSING — {$why}";
}

// gd or imagick is only needed if images are processed server-side.
(extension_loaded('gd') || extension_loaded('imagick'))
    ? $pass[] = 'ext-gd / ext-imagick (image handling)'
    : $warn[] = 'Neither ext-gd nor ext-imagick is available (only matters if images get resized server-side)';

// --- Symlink support -------------------------------------------------------
// public/storage is a symlink in the repo and FTP cannot transfer it, so the
// deploy script re-creates it here. If symlink() is blocked we fall back to a
// PHP file server instead.
$symlinkOk = false;
if (function_exists('symlink')) {
    $target = __DIR__.'/_symlink_probe_target';
    $link   = __DIR__.'/_symlink_probe_link';
    @mkdir($target);
    $symlinkOk = @symlink($target, $link);
    @unlink($link);
    @rmdir($target);
}

$symlinkOk
    ? $pass[] = 'symlink() works — public/storage can be linked natively'
    : $warn[] = 'symlink() is disabled — the deploy script will install the PHP fallback for /storage URLs';

// --- Writability -----------------------------------------------------------
// Laravel needs these writable at runtime; over FTP they often land as 0644.
// This file may sit at the web root (uploaded alone, before anything else) or
// inside public/ (uploaded with the project), so look for the app in both.
$base = null;
foreach ([__DIR__, dirname(__DIR__)] as $candidate) {
    if (is_file($candidate.'/artisan')) {
        $base = $candidate;
        break;
    }
}

foreach (['storage', 'bootstrap/cache'] as $dir) {
    $path = ($base ?? __DIR__).'/'.$dir;
    if ($base === null || ! is_dir($path)) {
        $warn[] = "{$dir}/ not found yet (upload the project first, then re-run)";
    } elseif (is_writable($path)) {
        $pass[] = "{$dir}/ is writable";
    } else {
        $fail[] = "{$dir}/ is NOT writable — chmod it to 775 over FTP";
    }
}

// --- mod_rewrite -----------------------------------------------------------
// Without rewriting, every route except the homepage returns 404.
if (function_exists('apache_get_modules')) {
    in_array('mod_rewrite', apache_get_modules(), true)
        ? $pass[] = 'Apache mod_rewrite is enabled'
        : $fail[] = 'Apache mod_rewrite is DISABLED — all routes except "/" will 404';
} else {
    $warn[] = 'Cannot detect mod_rewrite from PHP (normal on nginx / PHP-FPM) — verify with the host';
}

// --- Limits that break admin uploads ---------------------------------------
$limits = [
    'upload_max_filesize' => '8M',
    'post_max_size'       => '8M',
    'memory_limit'        => '256M',
];

$toBytes = static function (string $v): int {
    $v = trim($v);
    if ($v === '-1') {
        return PHP_INT_MAX;
    }
    $unit = strtolower(substr($v, -1));
    $n = (int) $v;

    return match ($unit) {
        'g' => $n * 1024 ** 3,
        'm' => $n * 1024 ** 2,
        'k' => $n * 1024,
        default => $n,
    };
};

foreach ($limits as $key => $min) {
    $actual = ini_get($key);
    $toBytes($actual) >= $toBytes($min)
        ? $pass[] = "{$key} = {$actual} (>= {$min})"
        : $warn[] = "{$key} = {$actual} is below the recommended {$min} — large logo/CV uploads may fail";
}

// --- Report ----------------------------------------------------------------
$line = str_repeat('=', 68);

echo "{$line}\nSHORA GROUP — SERVER CHECK\n{$line}\n\n";
echo 'Server software : '.($_SERVER['SERVER_SOFTWARE'] ?? 'unknown')."\n";
echo 'Document root   : '.($_SERVER['DOCUMENT_ROOT'] ?? 'unknown')."\n";
echo 'This file       : '.__FILE__."\n";
echo 'App root found  : '.($base ?? 'not uploaded yet').PHP_EOL;
echo 'PHP SAPI        : '.PHP_SAPI."\n\n";

foreach (['FAILED' => $fail, 'WARNINGS' => $warn, 'PASSED' => $pass] as $heading => $items) {
    if ($items === []) {
        continue;
    }
    echo "{$heading}\n".str_repeat('-', 68)."\n";
    foreach ($items as $item) {
        echo '  '.($heading === 'PASSED' ? '[ok]  ' : ($heading === 'FAILED' ? '[FAIL] ' : '[warn] ')).$item."\n";
    }
    echo "\n";
}

echo $line."\n";
echo $fail === []
    ? "RESULT: this server can run the application.\n"
    : 'RESULT: '.count($fail)." blocking problem(s) — fix these before uploading.\n";
echo $line."\n\nDelete this file when you are done.\n";
