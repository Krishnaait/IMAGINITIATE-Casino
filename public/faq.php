<?php
/**
 * FAQ Page
 */

require_once __DIR__ . '/../includes/init.php';

$pageTitle = 'FAQ - IMAGINITIATE Social Casino';
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <!-- Page Header -->
    <section class="hero" style="margin-bottom: 2rem;">
        <h1>❓ Frequently Asked Questions</h1>
        <p>Find answers to common questions about IMAGINITIATE and how to play.</p>
    </section>

    <!-- General Questions -->
    <section class="section">
        <h2>🎮 General Questions</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What is IMAGINITIATE?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    IMAGINITIATE is a free-to-play social casino platform designed purely for entertainment. 
                    It offers casino games like Roulette, Slots, Rummy, and Bingo using virtual coins with no real-world value. 
                    No real money is involved, and no withdrawals are possible.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is IMAGINITIATE free to play?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes, 100%! IMAGINITIATE is completely free. You start with 1000 free virtual coins, 
                    get 200 free coins daily, and can use free top-ups whenever needed. There are no hidden fees or charges.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Do I need to register or create an account?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    No! IMAGINITIATE requires no registration or login. Simply visit the website and start playing immediately. 
                    Your session is saved automatically using cookies.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is this real money gambling?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Absolutely not! IMAGINITIATE is a social casino for entertainment only. 
                    No real money is involved at any point. All transactions use virtual coins with no real-world value.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What's the minimum age requirement?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Players must be 18 years or older to use IMAGINITIATE. By accessing the platform, 
                    you confirm that you are 18 years of age or older.
                </p>
            </div>
        </div>
    </section>

    <!-- Credits & Coins -->
    <section class="section" style="background: rgba(155, 89, 182, 0.1); border: 2px solid var(--primary-purple);">
        <h2>💰 Credits & Coins</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How many coins do I start with?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    You start with 1000 free virtual coins when you first visit IMAGINITIATE. 
                    These coins are completely free and are yours to use for playing games.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I claim the daily bonus?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    You can claim 200 free coins once per day by clicking the "Claim Daily Bonus" button 
                    on the homepage or in the bonus section. The bonus resets at midnight (IST).
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What's the free top-up?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    When your coin balance drops below 100 coins, you can use the free top-up button 
                    to instantly receive 500 more coins. This ensures you never run out of coins to play with.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I withdraw my coins?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    No, virtual coins cannot be withdrawn or exchanged for money. 
                    They have no real-world value and exist purely for gameplay within IMAGINITIATE.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What happens if I lose all my coins?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    No problem! You have several options:
                </p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li>Claim your daily 200 coin bonus</li>
                    <li>Use the free top-up button (when balance is below 100)</li>
                    <li>Use the credit reset button (when balance is zero) to get 500 coins</li>
                </ul>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I buy coins with real money?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    No, IMAGINITIATE does not offer any real money purchases. 
                    All coins are earned through gameplay or given as free bonuses.
                </p>
            </div>
        </div>
    </section>

    <!-- Games -->
    <section class="section">
        <h2>🎮 Games</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How many games are available?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Currently, IMAGINITIATE offers 4 main games:
                </p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li><strong>Roulette:</strong> Predict where the ball lands on the wheel</li>
                    <li><strong>Slots:</strong> Match symbols on the reels to win</li>
                    <li><strong>Rummy:</strong> Arrange cards into sets and sequences</li>
                    <li><strong>Bingo:</strong> Mark numbers and complete patterns</li>
                </ul>
                <p>More games are coming soon!</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I play Roulette?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    In Roulette, you predict where the ball will land on the spinning wheel. 
                    You can bet on a specific number (36:1 odds), a color (2:1 odds), or a range like 1-18, 19-36, Even, or Odd (2:1 odds). 
                    If your prediction is correct, you win!
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I play Slots?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    In Slots, you spin the reels and try to match symbols. 
                    Three matching symbols win coins based on the symbol type (2x to 20x your bet). 
                    Even two matching symbols can win you 2x your bet!
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I play Rummy?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    In Rummy, you arrange your 13 cards into sets (3+ cards of same rank) and sequences (3+ cards in order). 
                    First to arrange all cards into valid sets and sequences wins! If you win, you get 3x your bet.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I play Bingo?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    In Bingo, you receive a 5x5 card with numbers 1-75. 
                    Numbers are called randomly, and you mark matching numbers. 
                    Complete patterns (lines, diagonals, or full card) to win coins (2x to 10x your bet).
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Are the games fair?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes! All IMAGINITIATE games use certified random number generation (RNG) to ensure fair and unbiased gameplay. 
                    Every outcome is completely random, and every player has equal chances of winning.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What are the odds in each game?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    <strong>Roulette:</strong> 36:1 for specific number, 2:1 for color/range
                </p>
                <p>
                    <strong>Slots:</strong> 2x to 20x your bet depending on symbols
                </p>
                <p>
                    <strong>Rummy:</strong> 3x your bet if you win
                </p>
                <p>
                    <strong>Bingo:</strong> 2x to 10x your bet depending on pattern
                </p>
            </div>
        </div>
    </section>

    <!-- Technical -->
    <section class="section" style="background: rgba(52, 152, 219, 0.1); border: 2px solid var(--info);">
        <h2>💻 Technical Questions</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Can I play on mobile?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes! IMAGINITIATE is fully responsive and works perfectly on laptops, tablets, and mobile devices. 
                    Play anytime, anywhere with the same great experience.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What browsers are supported?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    IMAGINITIATE works on all modern browsers including Chrome, Firefox, Safari, and Edge. 
                    For the best experience, please use the latest version of your browser.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is my data safe?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes, your session data is stored securely using encrypted cookies. 
                    We take privacy and security seriously and implement industry-standard security measures.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How is my session saved?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Your session is automatically saved using secure cookies. 
                    Your coin balance and game history are preserved across visits, so you can pick up where you left off anytime.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What if I clear my cookies?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    If you clear your cookies, your session will be reset and you'll start fresh with 1000 coins. 
                    To preserve your progress, avoid clearing cookies for imaginitiate.com.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Do you use sound?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes, IMAGINITIATE includes sound effects for clicks, wins, and losses. 
                    You can toggle sound on/off using the sound button in the header. Your preference is saved.
                </p>
            </div>
        </div>
    </section>

    <!-- Support -->
    <section class="section" style="background: rgba(231, 76, 60, 0.1); border: 2px solid var(--danger);">
        <h2>🆘 Support & Issues</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>I found a bug. How do I report it?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Please contact us at contact@imaginitiate.com with details about the bug, 
                    including what happened, when it happened, and what device/browser you were using. 
                    We'll investigate and fix it as soon as possible.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>The game isn't loading. What should I do?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Try these steps:
                </p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li>Refresh the page (F5 or Ctrl+R)</li>
                    <li>Clear your browser cache and cookies</li>
                    <li>Try a different browser</li>
                    <li>Check your internet connection</li>
                    <li>Disable browser extensions that might block content</li>
                </ul>
                <p>If the problem persists, contact us at contact@imaginitiate.com</p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>My coins disappeared. What happened?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Your coins are deducted when you place a bet in a game. 
                    If you lost coins unexpectedly, you may have accidentally started a game. 
                    Check your game history to see what happened. If you believe this is an error, contact us.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How do I contact support?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    You can reach our support team at:
                </p>
                <p><strong>Email:</strong> contact@imaginitiate.com</p>
                <p><strong>Address:</strong> A-96 GROUND FLOOR, SHANKAR GARDEN VIKASPURI, NEW DELHI, East Delhi, Delhi, 110018</p>
                <p>You can also use the contact form on our website.</p>
            </div>
        </div>
    </section>

    <!-- Responsible Gaming -->
    <section class="section">
        <h2>🛡️ Responsible Gaming</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is gaming addictive?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    While IMAGINITIATE is purely for entertainment with no real money involved, 
                    any activity can become habit-forming. We encourage responsible gaming practices 
                    and recommend setting time limits for your gaming sessions.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>How can I play responsibly?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Here are some tips for responsible gaming:
                </p>
                <ul style="color: var(--text-muted); margin-left: 1rem;">
                    <li>Set daily time limits for gaming</li>
                    <li>Take regular breaks during sessions</li>
                    <li>Don't let gaming interfere with work, school, or relationships</li>
                    <li>Remember it's for entertainment only</li>
                    <li>Set coin spending limits</li>
                    <li>Never play when stressed or upset</li>
                </ul>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What if I feel gaming is becoming a problem?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    If you feel gaming is becoming a problem or affecting your life negatively, 
                    please seek help from appropriate resources or counselors. 
                    Remember, IMAGINITIATE is purely for entertainment, and your well-being is what matters most.
                </p>
            </div>
        </div>
    </section>

    <!-- Legal -->
    <section class="section" style="background: rgba(243, 156, 18, 0.1); border: 2px solid var(--warning);">
        <h2>⚖️ Legal & Compliance</h2>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is IMAGINITIATE legal?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Yes, IMAGINITIATE is a legal social casino platform for entertainment purposes only. 
                    Since no real money is involved and virtual coins have no real-world value, 
                    it complies with gaming regulations in most jurisdictions.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What are your terms and conditions?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Please review our full Terms & Conditions page for complete legal information. 
                    You can access it from the footer of any page on IMAGINITIATE.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>What is your privacy policy?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    Our Privacy Policy explains how we collect, use, and protect your data. 
                    Please review it for complete information about your privacy rights. 
                    You can access it from the footer of any page.
                </p>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <strong>Is this gambling?</strong>
            </div>
            <div class="accordion-content">
                <p>
                    No, IMAGINITIATE is not gambling because no real money is involved. 
                    It's a social casino for entertainment using virtual coins with no real-world value. 
                    This is clearly stated in our disclaimer and compliance notices.
                </p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="text-align: center; background: linear-gradient(135deg, var(--primary-purple), var(--primary-gold));">
        <h2 style="color: var(--dark-bg);">Still Have Questions?</h2>
        <p style="color: var(--dark-bg); font-size: 1.2rem;">Contact us anytime!</p>
        <a href="/imaginitiate-casino/public/contact.php" class="btn btn-primary btn-lg" style="margin-top: 1rem;">Contact Support</a>
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
