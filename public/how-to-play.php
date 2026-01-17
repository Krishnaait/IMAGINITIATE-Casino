<?php
/**
 * How to Play Page
 */

require_once __DIR__ . '/../includes/init.php';

$pageTitle = 'How to Play - IMAGINITIATE Social Casino';
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <!-- Page Header -->
    <section class="hero" style="margin-bottom: 2rem;">
        <h1>📖 How to Play</h1>
        <p>Learn everything you need to know about IMAGINITIATE and how to maximize your gaming experience.</p>
    </section>

    <!-- Getting Started -->
    <section class="section">
        <h2>🚀 Getting Started</h2>
        <div class="grid grid-2">
            <div class="card">
                <div class="card-title">No Registration Needed</div>
                <p class="card-text">
                    IMAGINITIATE is completely free-to-play with no registration required. Simply visit the website 
                    and start playing immediately with 1000 free virtual coins!
                </p>
            </div>

            <div class="card">
                <div class="card-title">Instant Access</div>
                <p class="card-text">
                    Your session is saved automatically using cookies. Your coin balance and game history are 
                    preserved across visits, so you can pick up where you left off anytime.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Choose Your Game</div>
                <p class="card-text">
                    Browse our collection of 4 exciting games: Roulette, Slots, Rummy, and Bingo. Each game 
                    has detailed explanations and tutorials to help you get started.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Start Playing</div>
                <p class="card-text">
                    Select a game, place your bet using virtual coins, and start playing. Win coins and unlock 
                    achievements as you play!
                </p>
            </div>
        </div>
    </section>

    <!-- Credit System -->
    <section class="section" style="background: linear-gradient(135deg, rgba(155, 89, 182, 0.3) 0%, rgba(255, 215, 0, 0.1) 100%);">
        <h2>💰 Credit System</h2>

        <!-- Initial Credits -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">🎁 Initial Credits: 1000 Coins</div>
            <p class="card-text">
                When you first visit IMAGINITIATE, you automatically receive 1000 virtual coins to start playing. 
                These coins are completely free and have no real-world value. Use them to place bets and play games!
            </p>
            <div class="alert alert-info">
                <strong>💡 Tip:</strong> Start with smaller bets to learn the game mechanics before increasing your stakes.
            </div>
        </div>

        <!-- Daily Bonus -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">📅 Daily Bonus: 200 Coins</div>
            <p class="card-text">
                Claim 200 free coins every single day! Simply visit the website once per day to receive your bonus. 
                There's no limit to how many days you can claim—keep coming back for more free coins!
            </p>
            <div style="background: rgba(39, 174, 96, 0.2); padding: 1rem; border-radius: var(--border-radius); border: 2px solid var(--success);">
                <p style="margin: 0; color: var(--success);"><strong>✓ How to Claim:</strong></p>
                <p style="margin: 0.5rem 0 0 0; color: var(--text-muted);">
                    Click the "Claim Daily Bonus" button on the homepage or in the bonus section. 
                    You can claim once per day (resets at midnight IST).
                </p>
            </div>
        </div>

        <!-- Free Top-Up -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">🆓 Free Top-Up: 500 Coins</div>
            <p class="card-text">
                When your coin balance runs low (below 100 coins), you can use the free top-up button to instantly 
                receive 500 more coins. This keeps you playing without any interruption!
            </p>
            <div style="background: rgba(243, 156, 18, 0.2); padding: 1rem; border-radius: var(--border-radius); border: 2px solid var(--warning);">
                <p style="margin: 0; color: var(--warning);"><strong>⚠️ Important:</strong></p>
                <p style="margin: 0.5rem 0 0 0; color: var(--text-muted);">
                    Free top-up is only available when your balance is below 100 coins. 
                    This ensures you never run out of coins to play with!
                </p>
            </div>
        </div>

        <!-- Credit Reset -->
        <div class="card">
            <div class="card-title">🔄 Credit Reset: 500 Coins</div>
            <p class="card-text">
                If your balance reaches exactly zero, you can use the credit reset button to get 500 coins instantly. 
                This is a safety net to ensure you always have coins to play!
            </p>
            <div style="background: rgba(52, 152, 219, 0.2); padding: 1rem; border-radius: var(--border-radius); border: 2px solid var(--info);">
                <p style="margin: 0; color: var(--info);"><strong>ℹ️ Note:</strong></p>
                <p style="margin: 0.5rem 0 0 0; color: var(--text-muted);">
                    Credit reset can only be used when your balance is zero. 
                    After reset, you'll have 500 coins to continue playing.
                </p>
            </div>
        </div>
    </section>

    <!-- Game Guides -->
    <section class="section">
        <h2>🎮 Game Guides</h2>

        <!-- Roulette -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">🎡 Roulette</div>
            <p class="card-text"><strong>Objective:</strong> Predict where the ball will land on the spinning wheel.</p>
            <div style="background: rgba(22, 33, 62, 0.5); padding: 1rem; border-radius: var(--border-radius); margin-top: 1rem;">
                <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                <ol style="color: var(--text-muted); margin-left: 1.5rem;">
                    <li>Choose your bet type:
                        <ul style="margin-top: 0.5rem;">
                            <li><strong>Specific Number:</strong> Pick a number 0-36 (36:1 odds)</li>
                            <li><strong>Color:</strong> Choose Red or Black (2:1 odds)</li>
                            <li><strong>Range:</strong> Pick 1-18, 19-36, Even, or Odd (2:1 odds)</li>
                        </ul>
                    </li>
                    <li>Set your bet amount (10-1000 coins)</li>
                    <li>Click "Spin Wheel" to start the game</li>
                    <li>If the ball lands on your choice, you win!</li>
                    <li>Winnings depend on your bet type and odds</li>
                </ol>
            </div>
        </div>

        <!-- Slots -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">🎰 Classic Slots</div>
            <p class="card-text"><strong>Objective:</strong> Match symbols on the reels to win coins.</p>
            <div style="background: rgba(22, 33, 62, 0.5); padding: 1rem; border-radius: var(--border-radius); margin-top: 1rem;">
                <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                <ol style="color: var(--text-muted); margin-left: 1.5rem;">
                    <li>Set your bet amount (5-500 coins)</li>
                    <li>Click "Spin" to start the reels</li>
                    <li>Wait for the reels to stop spinning</li>
                    <li>Match symbols to win:
                        <ul style="margin-top: 0.5rem;">
                            <li>🍎 🍎 🍎 = 5x your bet</li>
                            <li>🍊 🍊 🍊 = 5x your bet</li>
                            <li>⭐ ⭐ ⭐ = 10x your bet</li>
                            <li>🎁 🎁 🎁 = 20x your bet</li>
                            <li>Any 2 match = 2x your bet</li>
                        </ul>
                    </li>
                    <li>More matches = bigger wins!</li>
                </ol>
            </div>
        </div>

        <!-- Rummy -->
        <div class="card" style="margin-bottom: 1.5rem;">
            <div class="card-title">🃏 Rummy</div>
            <p class="card-text"><strong>Objective:</strong> Arrange all your cards into valid sets and sequences.</p>
            <div style="background: rgba(22, 33, 62, 0.5); padding: 1rem; border-radius: var(--border-radius); margin-top: 1rem;">
                <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                <ol style="color: var(--text-muted); margin-left: 1.5rem;">
                    <li>Set your bet amount (10-500 coins)</li>
                    <li>You'll be dealt 13 cards</li>
                    <li>Arrange cards into:
                        <ul style="margin-top: 0.5rem;">
                            <li><strong>Sets:</strong> 3+ cards of the same rank (e.g., K♠ K♥ K♦)</li>
                            <li><strong>Sequences:</strong> 3+ cards in order (e.g., 5♠ 6♠ 7♠)</li>
                        </ul>
                    </li>
                    <li>Draw and discard cards strategically</li>
                    <li>First to arrange all cards into valid sets/sequences wins!</li>
                    <li>Win: 3x your bet</li>
                </ol>
            </div>
        </div>

        <!-- Bingo -->
        <div class="card">
            <div class="card-title">🎲 Bingo</div>
            <p class="card-text"><strong>Objective:</strong> Mark numbers as they're called and complete patterns to win.</p>
            <div style="background: rgba(22, 33, 62, 0.5); padding: 1rem; border-radius: var(--border-radius); margin-top: 1rem;">
                <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">How to Play:</h4>
                <ol style="color: var(--text-muted); margin-left: 1.5rem;">
                    <li>Set your bet amount (5-200 coins)</li>
                    <li>You'll receive a 5x5 bingo card with numbers 1-75</li>
                    <li>Numbers are called randomly</li>
                    <li>Mark matching numbers on your card</li>
                    <li>Complete patterns to win:
                        <ul style="margin-top: 0.5rem;">
                            <li>Horizontal Line = 2x your bet</li>
                            <li>Vertical Line = 2x your bet</li>
                            <li>Diagonal Line = 3x your bet</li>
                            <li>Four Corners = 4x your bet</li>
                            <li>Full Card = 10x your bet</li>
                        </ul>
                    </li>
                    <li>Multiple patterns = multiple wins!</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Tips & Strategies -->
    <section class="section" style="background: rgba(52, 152, 219, 0.1); border: 2px solid var(--info);">
        <h2>💡 Tips & Strategies</h2>
        <div class="grid grid-2">
            <div class="card">
                <div class="card-title">Start Small</div>
                <p class="card-text">
                    Begin with smaller bets to learn the game mechanics and understand how each game works 
                    before increasing your stakes.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Manage Your Coins</div>
                <p class="card-text">
                    Set a daily budget for your coins and stick to it. Remember, IMAGINITIATE is for entertainment, 
                    not to make money.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Claim Your Bonuses</div>
                <p class="card-text">
                    Don't forget to claim your daily 200 coin bonus every day and use the free top-up button 
                    when your balance runs low.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Learn the Rules</div>
                <p class="card-text">
                    Each game has detailed explanations. Take time to understand the rules and strategies 
                    before playing for real coins.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Play Multiple Games</div>
                <p class="card-text">
                    Try different games to find your favorites. Each game offers unique gameplay and winning opportunities.
                </p>
            </div>

            <div class="card">
                <div class="card-title">Take Breaks</div>
                <p class="card-text">
                    Play responsibly and take regular breaks. Don't let gaming interfere with your daily life 
                    or responsibilities.
                </p>
            </div>
        </div>
    </section>

    <!-- Achievements -->
    <section class="section">
        <h2>🏆 Achievements & Badges</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">
            Earn badges and achievements as you play. Unlock rewards and showcase your gaming prowess!
        </p>
        <div class="grid grid-4">
            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🌟</div>
                <p style="color: var(--primary-gold); font-weight: bold; margin: 0;">First Win</p>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0.5rem 0 0 0;">Win your first game</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">💰</div>
                <p style="color: var(--primary-gold); font-weight: bold; margin: 0;">High Roller</p>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0.5rem 0 0 0;">Win 1000+ coins</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🎮</div>
                <p style="color: var(--primary-gold); font-weight: bold; margin: 0;">Game Master</p>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0.5rem 0 0 0;">Play all 4 games</p>
            </div>

            <div class="card" style="text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🔥</div>
                <p style="color: var(--primary-gold); font-weight: bold; margin: 0;">Hot Streak</p>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0.5rem 0 0 0;">Win 5 games in a row</p>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section">
        <h2>❓ Frequently Asked Questions</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I withdraw my coins?</strong>
            </div>
            <div class="accordion-content">
                <p>No, virtual coins have no real-world value and cannot be withdrawn or exchanged for money. 
                This is purely for entertainment purposes.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is this real money gambling?</strong>
            </div>
            <div class="accordion-content">
                <p>Absolutely not! IMAGINITIATE is a social casino for entertainment only. No real money is involved 
                at any point. All transactions use virtual coins.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What happens if I lose all my coins?</strong>
            </div>
            <div class="accordion-content">
                <p>No problem! You can claim your daily 200 coin bonus, use the free top-up button (when balance is below 100), 
                or use the credit reset button (when balance is zero) to get more coins.</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I play on mobile?</strong>
            </div>
            <div class="accordion-content">
                <p>Yes! IMAGINITIATE is fully responsive and works perfectly on laptops, tablets, and mobile devices. 
                Play anytime, anywhere!</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is my data safe?</strong>
            </div>
            <div class="accordion-content">
                <p>Yes, your session data is stored securely using encrypted cookies. We take privacy and security seriously. 
                For more information, please review our Privacy Policy.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="text-align: center; background: linear-gradient(135deg, var(--primary-purple), var(--primary-gold));">
        <h2 style="color: var(--dark-bg);">Ready to Play?</h2>
        <p style="color: var(--dark-bg); font-size: 1.2rem;">Start your gaming adventure with 1000 free coins!</p>
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
