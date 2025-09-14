<?php
// Temporary debug script for production login issues
// Delete this file after debugging

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Login Debug Information</h2>";

// Check if Laravel can be bootstrapped
try {
    require_once __DIR__ . '/vendor/autoload.php';
    
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    
    echo "<p>✅ Laravel bootstrapped successfully</p>";
    
    // Check database connection
    try {
        $pdo = new PDO(
            'mysql:host=' . env('DB_HOST', '127.0.0.1') . ';dbname=' . env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
        echo "<p>✅ Database connection successful</p>";
        
        // Check if users table exists and has data
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users LIMIT 1");
        $result = $stmt->fetch();
        echo "<p>✅ Users table accessible (count: " . $result['count'] . ")</p>";
        
    } catch (Exception $e) {
        echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
    }
    
    // Check environment settings
    echo "<h3>Environment Settings:</h3>";
    echo "<p>APP_ENV: " . env('APP_ENV', 'not set') . "</p>";
    echo "<p>APP_DEBUG: " . (env('APP_DEBUG') ? 'true' : 'false') . "</p>";
    echo "<p>APP_URL: " . env('APP_URL', 'not set') . "</p>";
    
    // Check permissions
    echo "<h3>File Permissions:</h3>";
    echo "<p>storage/logs writable: " . (is_writable(__DIR__ . '/storage/logs') ? 'Yes' : 'No') . "</p>";
    echo "<p>storage/framework writable: " . (is_writable(__DIR__ . '/storage/framework') ? 'Yes' : 'No') . "</p>";
    
    // Check if there are recent logs
    $logFile = __DIR__ . '/storage/logs/laravel.log';
    if (file_exists($logFile)) {
        $logSize = filesize($logFile);
        $lastModified = date('Y-m-d H:i:s', filemtime($logFile));
        echo "<p>Log file exists: {$logSize} bytes, last modified: {$lastModified}</p>";
    } else {
        echo "<p>❌ No log file found</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Bootstrap error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr>";
echo "<p><strong>Instructions:</strong></p>";
echo "<ol>";
echo "<li>Try logging in with wrong credentials on your production site</li>";
echo "<li>Check storage/logs/laravel.log for new entries</li>";
echo "<li>Look for lines containing 'Login attempt started' or 'Validation Exception Details'</li>";
echo "<li>Delete this file after debugging</li>";
echo "</ol>";
?>