<?php
/**
 * API Endpoint - Reset Credits
 */

require_once __DIR__ . '/../includes/init.php';

header('Content-Type: application/json');

try {
    $sessionManager = getSessionManager();
    $result = $sessionManager->resetCredits();

    echo json_encode($result);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
