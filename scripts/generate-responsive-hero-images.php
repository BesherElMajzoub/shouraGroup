<?php

declare(strict_types=1);

ini_set('memory_limit', '512M');

/**
 * Generate the small WebP derivatives used by the homepage hero.
 * Run from the project root: php scripts/generate-responsive-hero-images.php
 */

$root = dirname(__DIR__);
$outputDirectory = $root.'/public/images/hero/responsive';

if (! is_dir($outputDirectory) && ! mkdir($outputDirectory, 0775, true) && ! is_dir($outputDirectory)) {
    throw new RuntimeException("Unable to create {$outputDirectory}");
}

$images = [
    'generators' => [$root.'/public/images/hero/Shora Generators Services.PNG', [128, 256]],
    'water-pumps' => [$root.'/public/images/hero/Shora Water pumps.PNG', [128, 256]],
    'compressors' => [$root.'/public/images/hero/compressors.png', [128, 256]],
    'medical' => [$root.'/public/images/hero/shora_medical.png', [128, 256]],
    'industrial-tools' => [$root.'/public/images/hero/image.png', [128, 256]],
    'mmb' => [$root.'/public/images/brands/mmb.png', [128, 256]],
    'shora-group' => [$root.'/public/images/hero/Shora Group Logo Offical Without BG.png', [256, 384]],
];

foreach ($images as $name => [$sourcePath, $widths]) {
    $source = imagecreatefrompng($sourcePath);

    if ($source === false) {
        throw new RuntimeException("Unable to read {$sourcePath}");
    }

    $sourceWidth = imagesx($source);
    $sourceHeight = imagesy($source);

    foreach ($widths as $width) {
        $height = max(1, (int) round($sourceHeight * ($width / $sourceWidth)));
        $target = imagecreatetruecolor($width, $height);

        imagealphablending($target, false);
        imagesavealpha($target, true);
        $transparent = imagecolorallocatealpha($target, 0, 0, 0, 127);
        imagefill($target, 0, 0, $transparent);

        imagecopyresampled($target, $source, 0, 0, 0, 0, $width, $height, $sourceWidth, $sourceHeight);

        $targetPath = "{$outputDirectory}/{$name}-{$width}.webp";
        if (! imagewebp($target, $targetPath, 82)) {
            throw new RuntimeException("Unable to write {$targetPath}");
        }

        imagedestroy($target);
        echo "Generated {$targetPath}\n";
    }

    imagedestroy($source);
}
