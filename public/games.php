<?php
/**
 * Games Listing Page
 */

require_once __DIR__ . '/../includes/init.php';

$pageTitle = 'All Games - IMAGINITIATE Social Casino';
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <!-- Page Header -->
    <section class="hero" style="margin-bottom: 2rem;">
        <h1>🎮 Our Games</h1>
        <p>Choose from our collection of exciting casino games. Each game is fully explained with easy-to-understand rules.</p>
    </section>

    <!-- Games Grid -->
    <section class="section">
        <div class="grid grid-2">
            <!-- Roulette -->
            <div class="card">
                <div style="font-size: 4rem; text-align: center; margin-bottom: 1rem;">🎡</div>
                <div class="card-title">Roulette</div>
                <p class="card-text">
                    Spin the wheel and predict where the ball will land. Choose your numbers, colors, or ranges. 
                    Simple rules, exciting gameplay!
                </p>
                <div style="margin-bottom: 1rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                    <ul style="color: var(--text-muted); margin-left: 1rem;">
                        <li>Place your bet on a number, color, or range</li>
                        <li>Click "Spin" to start the wheel</li>
                        <li>If the ball lands on your choice, you win!</li>
                        <li>Winnings depend on your bet type</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/roulette.php" class="btn btn-primary btn-lg" style="width: 100%;">Play Roulette</a>
                </div>
            </div>

            <!-- Slots -->
            <div class="card">
                <div style="font-size: 4rem; text-align: center; margin-bottom: 1rem;">🎰</div>
                <div class="card-title">Classic Slots</div>
                <p class="card-text">
                    Spin the reels and match symbols to win big! With smooth animations and exciting paylines, 
                    slots are the ultimate gaming thrill.
                </p>
                <div style="margin-bottom: 1rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                    <ul style="color: var(--text-muted); margin-left: 1rem;">
                        <li>Set your bet amount</li>
                        <li>Click "Spin" to start the reels</li>
                        <li>Match symbols to win</li>
                        <li>More matches = bigger wins!</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/slots.php" class="btn btn-primary btn-lg" style="width: 100%;">Play Slots</a>
                </div>
            </div>

            <!-- Rummy -->
            <div class="card">
                <div style="font-size: 4rem; text-align: center; margin-bottom: 1rem;">🃏</div>
                <div class="card-title">Rummy</div>
                <p class="card-text">
                    Test your strategy and skill! Arrange cards into sets and sequences. 
                    A classic card game that never gets old.
                </p>
                <div style="margin-bottom: 1rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                    <ul style="color: var(--text-muted); margin-left: 1rem;">
                        <li>Arrange cards into sets or sequences</li>
                        <li>Sets: 3+ cards of same rank</li>
                        <li>Sequences: 3+ cards in order</li>
                        <li>First to arrange all cards wins!</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/rummy.php" class="btn btn-primary btn-lg" style="width: 100%;">Play Rummy</a>
                </div>
            </div>

            <!-- Bingo -->
            <div class="card">
                <div style="font-size: 4rem; text-align: center; margin-bottom: 1rem;">🎲</div>
                <div class="card-title">Bingo</div>
                <p class="card-text">
                    Mark your numbers as they're called. Complete patterns to win! 
                    Fun, social, and easy to play.
                </p>
                <div style="margin-bottom: 1rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                    <ul style="color: var(--text-muted); margin-left: 1rem;">
                        <li>Numbers are called randomly</li>
                        <li>Mark matching numbers on your card</li>
                        <li>Complete a line or full card to win</li>
                        <li>Multiple patterns = multiple wins!</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/bingo.php" class="btn btn-primary btn-lg" style="width: 100%;">Play Bingo</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="section">
        <h2>🚀 Coming Soon</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 2rem;">
            We're working on more exciting games! Check back soon for updates.
        </p>
        <div class="grid grid-3">
            <div class="card" style="opacity: 0.6; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎴</div>
                <div class="card-title">Blackjack</div>
                <span class="compliance-badge">Coming Soon</span>
            </div>

            <div class="card" style="opacity: 0.6; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🃏</div>
                <div class="card-title">Poker</div>
                <span class="compliance-badge">Coming Soon</span>
            </div>

            <div class="card" style="opacity: 0.6; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎯</div>
                <div class="card-title">Craps</div>
                <span class="compliance-badge">Coming Soon</span>
            </div>
        </div>
    </section>

    <!-- Game Tips Section -->
    <section class="section" style="background: rgba(52, 152, 219, 0.1); border: 2px solid var(--info);">
        <h2>💡 Gaming Tips</h2>
        <div class="grid grid-2">
            <div>
                <h4>🎯 Start Small</h4>
                <p>Begin with smaller bets to learn the game mechanics before increasing your stakes.</p>
            </div>

            <div>
                <h4>💰 Manage Your Coins</h4>
                <p>Set a daily budget and stick to it. Remember, this is for entertainment!</p>
            </div>

            <div>
                <h4>📚 Learn the Rules</h4>
                <p>Each game has detailed explanations. Take time to understand before playing for real coins.</p>
            </div>

            <div>
                <h4>🎁 Claim Bonuses</h4>
                <p>Don't forget to claim your daily 200 coin bonus and use the free top-up button!</p>
            </div>

            <div>
                <h4>🎮 Have Fun</h4>
                <p>Remember, IMAGINITIATE is for entertainment. Enjoy the games and the experience!</p>
            </div>

            <div>
                <h4>⏰ Take Breaks</h4>
                <p>Play responsibly. Take regular breaks and don't let gaming interfere with daily life.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="text-align: center; background: linear-gradient(135deg, var(--primary-purple), var(--primary-gold));">
        <h2 style="color: var(--dark-bg);">Ready to Play?</h2>
        <p style="color: var(--dark-bg); font-size: 1.2rem;">Choose your favorite game and start winning virtual coins!</p>
        <div style="margin-top: 1rem;">
            <a href="/imaginitiate-casino/public/games/roulette.php" class="btn btn-primary btn-lg">Play Now</a>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
