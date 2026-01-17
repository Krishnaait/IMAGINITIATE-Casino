<?php
/**
 * Header Template
 * Include this file at the beginning of each page
 */

$sessionManager = getSessionManager();
$balance = $sessionManager->getBalance();
$pageTitle = isset($pageTitle) ? $pageTitle : 'IMAGINITIATE - Social Casino';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IMAGINITIATE - Free-to-Play Social Casino Games. Play Rummy, Roulette, Slots, and Bingo with virtual coins. No real money involved.">
    <meta name="keywords" content="social casino, free games, rummy, roulette, slots, bingo, virtual coins">
    <meta name="author" content="IMAGINITIATE VENTURES PRIVATE LIMITED">
    <meta name="theme-color" content="#FFD700">
    
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/imaginitiate-casino/assets/images/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/imaginitiate-casino/assets/css/style.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                IMAGINI<span>TIATE</span>
            </div>

            <!-- Navigation -->
            <nav>
                <a href="/imaginitiate-casino/public/index.php">Home</a>
                <a href="/imaginitiate-casino/public/games.php">Games</a>
                <a href="/imaginitiate-casino/public/how-to-play.php">How to Play</a>
                <a href="/imaginitiate-casino/public/about.php">About</a>
                <a href="/imaginitiate-casino/public/faq.php">FAQ</a>
                <a href="/imaginitiate-casino/public/contact.php">Contact</a>
            </nav>

            <!-- Header Right (Coin Display & Sound) -->
            <div class="header-right">
                <div class="coin-display">
                    💰 <?php echo number_format($balance); ?> Coins
                </div>
                <button class="sound-toggle" title="Toggle Sound">🔊 Sound</button>
                <button class="menu-toggle" title="Menu">☰</button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
