<?php
/**
 * IMAGINITIATE Social Casino - Configuration File
 * This file contains all configuration settings for the application
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'imaginitiate_casino');

// Application Settings
define('SITE_NAME', 'IMAGINITIATE');
define('SITE_URL', 'http://localhost/imaginitiate-casino/public/');
define('SITE_DOMAIN', 'imaginitiate.com');

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
define('ENABLE_HTTPS', false); // Set to true in production
define('DEBUG_MODE', true); // Set to false in production

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
