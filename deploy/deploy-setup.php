<?php
/**
 * Shora Group — post-upload setup runner.
 *
 * FTP-only hosting has no shell, so the artisan commands a deploy needs are
 * exposed here instead. Upload this file into public/ , set DEPLOY_TOKEN in
 * .env to a long random string, then visit:
 *
 *     https://your-domain.com/deploy-setup.php?token=YOUR_TOKEN
 *
 * DELETE THIS FILE as soon as the site is up. It can migrate your database.
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

/**
 * Read DEPLOY_TOKEN straight out of .env.
 *
 * env() cannot be used here: once this script has run config:cache, Laravel
 * stops loading .env altogether and every env() call returns null — which
 * would lock the tool out of itself right after a successful deploy.
 */
$readToken = static function (string $envFile): string {
    if (! is_readable($envFile)) {
        return '';
    }

    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (! str_starts_with(ltrim($line), 'DEPLOY_TOKEN=')) {
            continue;
        }

        $value = trim(substr(ltrim($line), strlen('DEPLOY_TOKEN=')));

        return trim($value, "\"'");
    }

    return '';
};

$expected = $readToken(__DIR__.'/../.env');
$given = (string) ($_GET['token'] ?? '');

if ($expected === '' || strlen($expected) < 24 || ! hash_equals($expected, $given)) {
    http_response_code(404);
    exit('Not Found');
}

$action = $_GET['action'] ?? 'info';
$output = '';

/** Run an artisan command and capture its output. */
$artisan = function (string $command, array $args = []) use (&$output): void {
    $buffer = new Symfony\Component\Console\Output\BufferedOutput;
    $status = Illuminate\Support\Facades\Artisan::call($command, $args, $buffer);
    $text = trim($buffer->fetch());

    $output .= "\$ php artisan {$command}\n";
    $output .= ($text === '' ? '(no output)' : $text)."\n";
    $output .= $status === 0 ? "-- ok\n\n" : "-- FAILED (exit {$status})\n\n";
};

/**
 * Recreate public/storage.
 *
 * FTP cannot transfer the symlink that lives in the repo, so it is rebuilt
 * here. Where open_basedir or the host blocks symlink(), a small PHP handler
 * is installed that streams the same files, keeping /storage/... URLs valid.
 */
$linkStorage = function () use (&$output): void {
    $link = public_path('storage');
    $target = storage_path('app/public');

    $output .= "\$ storage link\n";

    if (is_link($link)) {
        $output .= "already a symlink -> ".readlink($link)."\n-- ok\n\n";

        return;
    }

    if (! is_dir($target)) {
        @mkdir($target, 0775, true);
    }

    // A stale plain directory from a previous FTP upload would shadow the link.
    if (is_dir($link) && ! is_link($link) && ! is_file($link.'/index.php')) {
        $output .= "warning: public/storage exists as a real directory\n";
    }

    if (! file_exists($link) && @symlink($target, $link)) {
        $output .= "symlink created -> {$target}\n-- ok\n\n";

        return;
    }

    // Fallback: serve storage files through PHP.
    @mkdir($link, 0775, true);

    $handler = <<<'PHP'
<?php
// Fallback for hosts where symlink() is unavailable: stream files out of
// storage/app/public so that /storage/... URLs keep working.
$root = realpath(__DIR__.'/../../storage/app/public');
$rel = $_GET['file'] ?? '';
$path = realpath($root.'/'.$rel);

if ($root === false || $path === false || ! str_starts_with($path, $root.DIRECTORY_SEPARATOR) || ! is_file($path)) {
    http_response_code(404);
    exit('Not Found');
}

$mime = (new finfo(FILEINFO_MIME_TYPE))->file($path) ?: 'application/octet-stream';

header('Content-Type: '.$mime);
header('Content-Length: '.filesize($path));
header('Cache-Control: public, max-age=31536000');
readfile($path);
PHP;

    $htaccess = <<<'HTACCESS'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /storage/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php?file=$1 [L,QSA]
</IfModule>
HTACCESS;

    $wroteHandler = file_put_contents($link.'/index.php', $handler) !== false;
    $wroteRules = file_put_contents($link.'/.htaccess', $htaccess) !== false;

    $output .= $wroteHandler && $wroteRules
        ? "symlink() unavailable — installed PHP fallback handler in public/storage\n-- ok\n\n"
        : "could not create the link OR the fallback — chmod public/ to 775 and retry\n-- FAILED\n\n";
};

/** Report whether the paths Laravel writes to are actually writable. */
$checkPaths = function () use (&$output): void {
    $output .= "\$ writability\n";

    foreach ([
        storage_path('framework/views'),
        storage_path('framework/cache'),
        storage_path('framework/sessions'),
        storage_path('logs'),
        storage_path('app/public'),
        base_path('bootstrap/cache'),
    ] as $path) {
        if (! is_dir($path)) {
            @mkdir($path, 0775, true);
        }

        $label = str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);
        $output .= sprintf("  %-34s %s\n", $label, is_writable($path) ? 'writable' : 'NOT WRITABLE — chmod 775');
    }

    $output .= "\n";
};

switch ($action) {
    case 'migrate':
        $artisan('migrate', ['--force' => true]);
        break;

    case 'link':
        $linkStorage();
        break;

    case 'optimize':
        // Caching config bakes the current .env in; re-run after any .env edit.
        $artisan('config:cache');
        $artisan('route:cache');
        $artisan('view:cache');
        break;

    case 'clear':
        $artisan('optimize:clear');
        break;

    case 'all':
        $checkPaths();
        $artisan('migrate', ['--force' => true]);
        $linkStorage();
        $artisan('optimize:clear');
        $artisan('config:cache');
        $artisan('route:cache');
        $artisan('view:cache');
        break;

    case 'password':
        // The seeded admin password is 'password'. It has to be replaced before
        // the site is public, and there is no shell here to run tinker.
        $email = trim((string) ($_POST['email'] ?? ''));
        $new = (string) ($_POST['password'] ?? '');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $output .= "Submit the form below to set a new admin password.\n";
            break;
        }

        $output .= "$ set admin password\n";

        if (strlen($new) < 12) {
            $output .= "password must be at least 12 characters\n-- FAILED\n\n";
            break;
        }

        $user = App\Models\User::where('email', $email)->first();

        if ($user === null) {
            $output .= "no user with the address {$email}\n-- FAILED\n\n";
            break;
        }

        $user->forceFill(['password' => Illuminate\Support\Facades\Hash::make($new)])->save();
        $output .= "password updated for {$email}\n-- ok\n\n";
        break;

    case 'info':
    default:
        $checkPaths();
        $artisan('about');
        $artisan('migrate:status');
        break;
}

$token = urlencode($given);
$actions = ['info', 'all', 'migrate', 'link', 'optimize', 'clear', 'password'];
$links = implode('  |  ', array_map(
    fn (string $a): string => sprintf('<a href="?token=%s&action=%s">%s</a>', $token, $a, $a),
    $actions
));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <title>Deploy setup</title>
    <style>
        body { font: 14px/1.6 ui-monospace, SFMono-Regular, Menlo, monospace; margin: 2rem auto; max-width: 60rem; padding: 0 1rem; }
        nav { margin-bottom: 1rem; }
        pre { background: #111; color: #eee; padding: 1rem; overflow-x: auto; border-radius: 6px; }
        .warn { background: #fff4e5; border-left: 4px solid #d97706; padding: .75rem 1rem; }
    </style>
</head>
<body>
    <h1>Deploy setup — <?= htmlspecialchars($action, ENT_QUOTES) ?></h1>
    <nav><?= $links ?></nav>
    <pre><?= htmlspecialchars($output, ENT_QUOTES) ?></pre>
<?php if ($action === 'password'): ?>
    <form method="post" action="?token=<?= $token ?>&amp;action=password">
        <p><label>Admin e-mail<br><input type="email" name="email" value="admin@shora.sy" size="40" required></label></p>
        <p><label>New password (12 characters or more)<br><input type="password" name="password" minlength="12" size="40" required></label></p>
        <p><button type="submit">Update password</button></p>
    </form>
<?php endif; ?>
    <p class="warn"><strong>Delete this file</strong> (public/deploy-setup.php) once the site works.</p>
</body>
</html>
