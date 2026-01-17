<?php
/**
 * Homepage - IMAGINITIATE Social Casino
 */

require_once __DIR__ . '/../includes/init.php';

$pageTitle = 'IMAGINITIATE - Free-to-Play Social Casino Games';
include __DIR__ . '/../includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>🎰 Play Free Social Casino Games</h1>
        <p>Experience thrilling casino games with virtual coins. No real money, no risk, just pure entertainment!</p>
        
        <div class="compliance-badge" style="display: inline-block; margin-bottom: 2rem;">
            ✓ For Entertainment Purposes Only - No Real Money Involved
        </div>

        <div class="cta-buttons">
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-primary btn-lg">🎮 Play Games Now</a>
            <a href="/imaginitiate-casino/public/how-to-play.php" class="btn btn-secondary btn-lg">📖 How to Play</a>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <!-- Features Section -->
    <section class="section">
        <h2>Why Choose IMAGINITIATE?</h2>
        <div class="grid grid-3">
            <div class="card">
                <div class="card-title">💰 100% Free to Play</div>
                <p class="card-text">No deposits, no purchases, no real money involved. Play with virtual coins and enjoy unlimited entertainment.</p>
            </div>

            <div class="card">
                <div class="card-title">🎯 Easy to Learn</div>
                <p class="card-text">Each game comes with clear explanations and tutorials. Perfect for beginners and experienced players alike.</p>
            </div>

            <div class="card">
                <div class="card-title">✨ Daily Bonuses</div>
                <p class="card-text">Claim 200 free coins every day! Plus, get a free top-up button when your credits run out.</p>
            </div>

            <div class="card">
                <div class="card-title">🎨 Beautiful Graphics</div>
                <p class="card-text">Enjoy smooth animations and stunning visuals designed for the best gaming experience.</p>
            </div>

            <div class="card">
                <div class="card-title">📱 Fully Responsive</div>
                <p class="card-text">Play on your laptop, tablet, or mobile device. IMAGINITIATE works perfectly on all screens.</p>
            </div>

            <div class="card">
                <div class="card-title">🎁 Achievements</div>
                <p class="card-text">Earn badges and achievements as you play. Unlock rewards and showcase your gaming prowess.</p>
            </div>
        </div>
    </section>

    <!-- Games Section -->
    <section class="section">
        <h2>Our Games</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 2rem;">
            Choose from our collection of exciting casino games. Each game is fully explained with easy-to-understand rules.
        </p>

        <div class="grid grid-2">
            <!-- Roulette -->
            <div class="card">
                <div class="card-title">🎡 Roulette</div>
                <p class="card-text">
                    Spin the wheel and predict where the ball will land. Choose your numbers, colors, or ranges. 
                    Simple rules, exciting gameplay!
                </p>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/roulette.php" class="btn btn-primary">Play Roulette</a>
                </div>
            </div>

            <!-- Slots -->
            <div class="card">
                <div class="card-title">🎰 Classic Slots</div>
                <p class="card-text">
                    Spin the reels and match symbols to win big! With smooth animations and exciting paylines, 
                    slots are the ultimate gaming thrill.
                </p>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/slots.php" class="btn btn-primary">Play Slots</a>
                </div>
            </div>

            <!-- Rummy -->
            <div class="card">
                <div class="card-title">🃏 Rummy</div>
                <p class="card-text">
                    Test your strategy and skill! Arrange cards into sets and sequences. 
                    A classic card game that never gets old.
                </p>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/rummy.php" class="btn btn-primary">Play Rummy</a>
                </div>
            </div>

            <!-- Bingo -->
            <div class="card">
                <div class="card-title">🎲 Bingo</div>
                <p class="card-text">
                    Mark your numbers as they're called. Complete patterns to win! 
                    Fun, social, and easy to play.
                </p>
                <div class="card-footer">
                    <a href="/imaginitiate-casino/public/games/bingo.php" class="btn btn-primary">Play Bingo</a>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-secondary btn-lg">View All Games</a>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section">
        <h2>How It Works</h2>
        <div class="grid grid-4">
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">1️⃣</div>
                <div class="card-title">Start Playing</div>
                <p class="card-text">No registration needed! Start with 1000 free coins immediately.</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">2️⃣</div>
                <div class="card-title">Choose a Game</div>
                <p class="card-text">Pick from Roulette, Slots, Rummy, or Bingo.</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">3️⃣</div>
                <div class="card-title">Place Your Bet</div>
                <p class="card-text">Bet your virtual coins and play!</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">4️⃣</div>
                <div class="card-title">Win & Enjoy</div>
                <p class="card-text">Win coins and unlock achievements!</p>
            </div>
        </div>

        <div class="alert alert-info" style="margin-top: 2rem;">
            <strong>💡 Pro Tip:</strong> Claim your daily bonus of 200 coins every day! When your coins run out, 
            use the free top-up button to get 500 more coins instantly.
        </div>
    </section>

    <!-- Daily Bonus Section -->
    <section class="section" style="background: linear-gradient(135deg, rgba(155, 89, 182, 0.3) 0%, rgba(255, 215, 0, 0.1) 100%);">
        <h2 style="text-align: center;">🎁 Daily Bonus & Credits System</h2>
        <div class="grid grid-2">
            <div class="card">
                <div class="card-title">📅 Daily Bonus</div>
                <p class="card-text">
                    <strong>Claim 200 free coins every day!</strong> Simply visit the site once per day to get your bonus. 
                    No limits, no catch—just pure rewards for playing!
                </p>
                <button class="btn btn-success" onclick="claimDailyBonus()">Claim Daily Bonus</button>
            </div>

            <div class="card">
                <div class="card-title">🆓 Free Top-Up</div>
                <p class="card-text">
                    <strong>Out of coins?</strong> No problem! Use our free top-up button to instantly get 500 more coins. 
                    Play as much as you want, whenever you want!
                </p>
                <button class="btn btn-success" onclick="freeTopUp()">Get Free Top-Up</button>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section">
        <h2>Frequently Asked Questions</h2>
        
        <div class="accordion">
            <div class="accordion-header">
                <strong>❓ Do I need to create an account?</strong>
            </div>
            <div class="accordion-content">
                <p>No! IMAGINITIATE is completely free-to-play with no registration required. Just visit the site and start playing immediately.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>❓ Can I withdraw my coins?</strong>
            </div>
            <div class="accordion-content">
                <p>No, virtual coins have no real-world value and cannot be withdrawn or exchanged for money. This is purely for entertainment.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>❓ Is this real money gambling?</strong>
            </div>
            <div class="accordion-content">
                <p>Absolutely not! IMAGINITIATE is a social casino for entertainment only. No real money is involved at any point.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>❓ How often can I claim the daily bonus?</strong>
            </div>
            <div class="accordion-content">
                <p>You can claim 200 free coins once per day. The bonus resets at midnight (IST).</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>❓ What's the minimum age requirement?</strong>
            </div>
            <div class="accordion-content">
                <p>Players must be 18 years or older to use IMAGINITIATE. This is for entertainment purposes only.</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="/imaginitiate-casino/public/faq.php" class="btn btn-secondary">View All FAQs</a>
        </div>
    </section>

    <!-- Compliance Section -->
    <section class="section" style="background: rgba(231, 76, 60, 0.1); border: 2px solid var(--danger);">
        <h2 style="text-align: center; color: var(--danger);">⚠️ Important Compliance Notice</h2>
        
        <div class="grid grid-2">
            <div>
                <h4>🎮 Entertainment Only</h4>
                <p>IMAGINITIATE is a social casino platform designed purely for entertainment. No real money gambling is involved.</p>
            </div>

            <div>
                <h4>💰 No Real Money</h4>
                <p>Virtual coins have no real-world value and cannot be converted to cash or withdrawn in any form.</p>
            </div>

            <div>
                <h4>👤 18+ Age Restriction</h4>
                <p>By using IMAGINITIATE, you confirm that you are 18 years of age or older.</p>
            </div>

            <div>
                <h4>📋 Fair Play</h4>
                <p>All games use random number generation to ensure fair and unbiased gameplay.</p>
            </div>
        </div>

        <div class="alert alert-warning" style="margin-top: 2rem;">
            <strong>For more information, please review our:</strong>
            <ul style="margin-top: 1rem;">
                <li><a href="/imaginitiate-casino/public/disclaimer.php">Disclaimer</a></li>
                <li><a href="/imaginitiate-casino/public/terms.php">Terms & Conditions</a></li>
                <li><a href="/imaginitiate-casino/public/responsible-gaming.php">Responsible Gaming Guidelines</a></li>
            </ul>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="text-align: center; background: linear-gradient(135deg, var(--primary-purple), var(--primary-gold));">
        <h2 style="color: var(--dark-bg);">Ready to Play?</h2>
        <p style="color: var(--dark-bg); font-size: 1.2rem;">Start your gaming adventure with 1000 free coins. No registration, no deposits, just pure fun!</p>
        <a href="/imaginitiate-casino/public/games.php" class="btn btn-primary btn-lg" style="margin-top: 1rem;">🎮 Play Now</a>
    </section>
</div>

<!-- Accordion Styles -->
<style>
    .accordion {
        background: rgba(22, 33, 62, 0.7);
        border: 1px solid var(--primary-purple);
        border-radius: var(--border-radius);
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .accordion-header {
        padding: 1.5rem;
        cursor: pointer;
        background: rgba(22, 33, 62, 0.7);
        border-bottom: 1px solid var(--primary-purple);
        transition: var(--transition);
        user-select: none;
    }

    .accordion-header:hover {
        background: rgba(155, 89, 182, 0.2);
    }

    .accordion-content {
        display: none;
        padding: 1.5rem;
        background: rgba(26, 26, 46, 0.5);
    }

    .accordion.active .accordion-content {
        display: block;
    }

    .accordion-header::after {
        content: " ▼";
        float: right;
        transition: var(--transition);
    }

    .accordion.active .accordion-header::after {
        transform: rotate(180deg);
    }
</style>

<?php include __DIR__ . '/../includes/footer.php'; ?>
