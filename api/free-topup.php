<?php
/**
 * API Endpoint - Free Top-Up
 */

require_once __DIR__ . '/../includes/init.php';

header('Content-Type: application/json');

try {
    $sessionManager = getSessionManager();
    $balance = $sessionManager->getBalance();

    // Only allow top-up if balance is low
    if ($balance > 100) {
        echo json_encode([
            'success' => false,
            'message' => 'Free top-up is only available when your balance is low (below 100 coins)'
        ]);
        exit;
    }

    // Add top-up coins
    $topupAmount = 500;
    $sessionManager->addCoins($topupAmount, 'Free Top-Up');

    echo json_encode([
        'success' => true,
        'message' => 'Free top-up successful!',
        'amount' => $topupAmount,
        'newBalance' => $sessionManager->getBalance()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
