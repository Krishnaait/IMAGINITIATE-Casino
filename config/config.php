<?php
/**
 * IMAGINITIATE Social Casino - Configuration File
 * This file contains all configuration settings for the application
 */

// Database Configuration
// Support for Railway and other cloud platforms
define('DB_HOST', getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('MYSQLUSER') ?: getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: 'imaginitiate_casino');
define('DB_PORT', getenv('MYSQLPORT') ?: getenv('DB_PORT') ?: 3306);

// Application Settings
define('SITE_NAME', 'IMAGINITIATE');
define('SITE_URL', getenv('RAILWAY_PUBLIC_DOMAIN') ? 'https://' . getenv('RAILWAY_PUBLIC_DOMAIN') . '/' : 'http://localhost/imaginitiate-casino/public/');
define('SITE_DOMAIN', getenv('RAILWAY_PUBLIC_DOMAIN') ?: 'imaginitiate.com');
define('APP_ENV', getenv('APP_ENV') ?: 'development');

// Company Information
define('COMPANY_NAME', 'IMAGINITIATE VENTURES PRIVATE LIMITED');
define('COMPANY_ADDRESS', 'A-96 GROUND FLOOR, SHANKAR GARDEN VIKASPURI, NEW DELHI, East Delhi, Delhi, 110018');
define('COMPANY_EMAIL', 'contact@imaginitiate.com');
define('COMPANY_PHONE', '+91-XXXXXXXXXX');

// Virtual Coin Settings
define('INITIAL_CREDITS', 1000);
define('DAILY_BONUS_CREDITS', 200);
define('RESET_CREDITS', 500);
define('MIN_CREDITS_WARNING', 100);

// Game Settings
define('ROULETTE_MIN_BET', 10);
define('ROULETTE_MAX_BET', 1000);
define('SLOTS_MIN_BET', 5);
define('SLOTS_MAX_BET', 500);
define('RUMMY_MIN_BET', 10);
define('RUMMY_MAX_BET', 500);
define('BINGO_MIN_BET', 5);
define('BINGO_MAX_BET', 200);

// Session Settings
define('SESSION_TIMEOUT', 3600); // 1 hour
define('COOKIE_LIFETIME', 2592000); // 30 days

// Security Settings
define('ENABLE_HTTPS', getenv('APP_ENV') === 'production' ? true : false);
define('DEBUG_MODE', getenv('APP_ENV') === 'production' ? false : true);

// Compliance Settings
define('MIN_AGE', 18);
define('COMPLIANCE_TEXT', 'For Entertainment Purposes Only - No Real Money Involved');

// Error Logging
define('LOG_ERRORS', true);
define('LOG_PATH', __DIR__ . '/../logs/');

// Create logs directory if it doesn't exist
if (!is_dir(LOG_PATH)) {
    mkdir(LOG_PATH, 0755, true);
}

// Set error reporting
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

// Set timezone
date_default_timezone_set('Asia/Kolkata');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
