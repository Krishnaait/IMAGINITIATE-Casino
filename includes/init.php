<?php
/**
 * Application Initialization File
 * This file loads all necessary configurations and classes
 */

// Load configuration
require_once __DIR__ . '/../config/config.php';

// Load database class
require_once __DIR__ . '/Database.php';

// Load session manager
require_once __DIR__ . '/SessionManager.php';

// Initialize database tables
initializeDatabaseTables();

// Initialize session manager globally
$sessionManager = new SessionManager();

// Helper function to get session manager
function getSessionManager() {
    global $sessionManager;
    return $sessionManager;
}

// Helper function to format currency
function formatCoins($amount) {
    return number_format($amount, 0) . ' Coins';
}

// Helper function to sanitize input
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Helper function to log errors
function logError($message) {
    if (LOG_ERRORS) {
        $logFile = LOG_PATH . 'error_' . date('Y-m-d') . '.log';
        error_log('[' . date('Y-m-d H:i:s') . '] ' . $message . "\n", 3, $logFile);
    }
}

// Set up error handler
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    logError("Error [$errno] in $errfile:$errline - $errstr");
    return true;
});

// Set up exception handler
set_exception_handler(function($exception) {
    logError("Exception: " . $exception->getMessage());
    if (DEBUG_MODE) {
        echo "<pre>";
        echo $exception->getMessage();
        echo "</pre>";
    }
});
?>
