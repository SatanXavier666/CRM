<?php
echo "<h1>Deployment Check</h1><pre>";

$base = '/home/u458200173/domains/master.astracareportal.com';
$paths = [
    'Base directory' => $base,
    'Upload folder' => $base . '/upload',
    'Upload/public/build' => $base . '/upload/public/build',
    'Upload/resources' => $base . '/upload/resources',
    'Private_html folder' => $base . '/private_html',
    'Master.astracareportal.com folder' => $base,
];

foreach ($paths as $name => $path) {
    echo "$name: $path\n";
    if (file_exists($path)) {
        echo "  ✓ EXISTS\n";
        if (is_dir($path)) {
            $files = scandir($path);
            echo "  Contents: " . implode(', ', array_slice($files, 2, 10)) . "\n";
        }
    } else {
        echo "  ✗ NOT FOUND\n";
    }
    echo "\n";
}

echo "\n--- Alternative locations ---\n";
$altPaths = [
    '/home/u458200173/master.astracareportal.com',
    '/home/u458200173/domains/master.astracareportal.com/master.astracareportal.com',
];

foreach ($altPaths as $path) {
    if (file_exists($path)) {
        echo "✓ FOUND: $path\n";
        if (is_dir($path)) {
            echo "  Contents: " . implode(', ', array_slice(scandir($path), 2, 10)) . "\n";
        }
    }
}

echo "</pre>";
?>
