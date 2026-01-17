<?php
/**
 * API Endpoint - Get Current Coin Balance
 */

require_once __DIR__ . '/../includes/init.php';

header('Content-Type: application/json');

try {
    $sessionManager = getSessionManager();
    $balance = $sessionManager->getBalance();

    echo json_encode([
        'success' => true,
        'balance' => $balance,
        'formatted' => formatCoins($balance)
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
