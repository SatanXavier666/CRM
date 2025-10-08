<?php
/**
 * Auto-Deploy Script for AstraCare Portal
 * Upload this file to: /home/u458200173/domains/master.astracareportal.com/private_html/
 * Then visit: https://master.astracareportal.com/deploy-now.php
 */

set_time_limit(300);
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><title>AstraCare Deployment</title><style>
body { font-family: monospace; background: #1a1a1a; color: #00ff00; padding: 20px; }
.success { color: #00ff00; }
.error { color: #ff0000; }
.info { color: #00aaff; }
pre { background: #000; padding: 10px; border-left: 3px solid #00ff00; }
</style></head><body>";

echo "<h1>🚀 AstraCare Portal - Auto Deployment</h1>";
echo "<pre>";

$baseDir = '/home/u458200173/domains/master.astracareportal.com';
$uploadDir = $baseDir . '/upload';
$privateDir = $baseDir . '/private_html';

echo "<span class='info'>📂 Base Directory: $baseDir</span>\n";
echo "<span class='info'>📥 Upload Directory: $uploadDir</span>\n";
echo "<span class='info'>🎯 Target Directory: $privateDir</span>\n\n";

// Check if upload directory exists
if (!is_dir($uploadDir)) {
    echo "<span class='error'>❌ Error: Upload directory not found!</span>\n";
    echo "Expected: $uploadDir\n";
    exit;
}

echo "<span class='success'>✓ Upload directory found</span>\n\n";

// Define file mappings
$filesToCopy = [
    'public/build' => 'public/build',
    'resources/js/Pages' => 'resources/js/Pages',
    'resources/js/Components' => 'resources/js/Components',
    'routes/web.php' => 'routes/web.php',
];

// Function to recursively copy directory
function copyDirectory($src, $dst) {
    if (!is_dir($src)) {
        return copy($src, $dst);
    }

    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }

    $dir = opendir($src);
    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
    return true;
}

// Copy files
echo "📦 <span class='info'>Starting file deployment...</span>\n\n";

foreach ($filesToCopy as $source => $destination) {
    $sourcePath = $uploadDir . '/' . $source;
    $destPath = $privateDir . '/' . $destination;

    echo "📁 Processing: $source\n";

    if (!file_exists($sourcePath)) {
        echo "   <span class='error'>⚠️  Source not found: $sourcePath</span>\n";
        continue;
    }

    // Create destination directory if needed
    $destDir = dirname($destPath);
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
        echo "   📂 Created directory: $destDir\n";
    }

    // Copy files
    if (is_dir($sourcePath)) {
        if (copyDirectory($sourcePath, $destPath)) {
            echo "   <span class='success'>✓ Copied directory to: $destPath</span>\n";
        } else {
            echo "   <span class='error'>✗ Failed to copy: $sourcePath</span>\n";
        }
    } else {
        if (copy($sourcePath, $destPath)) {
            echo "   <span class='success'>✓ Copied file to: $destPath</span>\n";
        } else {
            echo "   <span class='error'>✗ Failed to copy: $sourcePath</span>\n";
        }
    }

    echo "\n";
}

// Clear Laravel caches
echo "🧹 <span class='info'>Clearing Laravel caches...</span>\n\n";

chdir($privateDir);

$commands = [
    'php artisan optimize:clear' => 'Clear all caches',
    'php artisan config:cache' => 'Cache configuration',
    'php artisan route:cache' => 'Cache routes',
    'php artisan view:cache' => 'Cache views',
];

foreach ($commands as $cmd => $desc) {
    echo "⚡ $desc: ";
    $output = [];
    $returnCode = 0;
    exec($cmd . ' 2>&1', $output, $returnCode);

    if ($returnCode === 0) {
        echo "<span class='success'>✓ Success</span>\n";
    } else {
        echo "<span class='error'>✗ Failed</span>\n";
        echo "   Output: " . implode("\n   ", $output) . "\n";
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "<span class='success'>✅ DEPLOYMENT COMPLETED SUCCESSFULLY!</span>\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "<span class='info'>🌐 Your site is now live with:</span>\n";
echo "   • Premium dark theme with neon effects ✨\n";
echo "   • Animated floating orbs 🌀\n";
echo "   • Server status monitoring 🟢\n";
echo "   • Health check endpoint 🏥\n\n";

echo "<span class='info'>📍 Visit your site:</span>\n";
echo "   🏠 Homepage: <a href='https://master.astracareportal.com' style='color:#00aaff'>https://master.astracareportal.com</a>\n";
echo "   🔐 Login: <a href='https://master.astracareportal.com/login' style='color:#00aaff'>https://master.astracareportal.com/login</a>\n";
echo "   🏥 Health: <a href='https://master.astracareportal.com/health' style='color:#00aaff'>https://master.astracareportal.com/health</a>\n\n";

echo "<span class='info'>🗑️  Cleanup (optional):</span>\n";
echo "   You can now delete:\n";
echo "   • /upload/ folder (deployment files)\n";
echo "   • This deploy-now.php file\n\n";

echo "═══════════════════════════════════════════════════════════\n\n";

// Display file summary
echo "<span class='info'>📊 Deployed Files Summary:</span>\n\n";

$deployedFiles = [
    $privateDir . '/public/build/assets',
    $privateDir . '/resources/js/Pages',
    $privateDir . '/resources/js/Components',
    $privateDir . '/routes/web.php',
];

foreach ($deployedFiles as $path) {
    if (file_exists($path)) {
        if (is_dir($path)) {
            $fileCount = count(glob($path . '/*'));
            echo "   ✓ $path ($fileCount items)\n";
        } else {
            echo "   ✓ $path (" . filesize($path) . " bytes)\n";
        }
    } else {
        echo "   ✗ $path (not found)\n";
    }
}

echo "</pre>";
echo "<p style='text-align:center; color:#00aaff; margin-top:40px;'>Built with ❤️ by Terragon Labs</p>";
echo "</body></html>";
?>
