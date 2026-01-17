<?php
/**
 * Slots Game
 */

require_once __DIR__ . '/../../includes/init.php';

$pageTitle = 'Slots - IMAGINITIATE Social Casino';
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
    <div class="game-container">
        <!-- Game Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>🎰 Classic Slots</h1>
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-secondary">← Back to Games</a>
        </div>

        <!-- Game Info -->
        <div class="alert alert-info" style="margin-bottom: 2rem;">
            <strong>How to Play:</strong> Set your bet amount and click "Spin" to start the reels. 
            Match symbols to win! More matching symbols = bigger wins!
        </div>

        <div class="grid grid-2" style="margin-bottom: 2rem;">
            <!-- Game Area -->
            <div class="card">
                <h3 style="text-align: center; margin-bottom: 2rem;">Spin the Reels</h3>
                
                <!-- Slot Machine -->
                <div style="
                    background: linear-gradient(135deg, #1a1a2e, #16213e);
                    padding: 2rem;
                    border-radius: var(--border-radius);
                    border: 3px solid var(--primary-gold);
                    margin-bottom: 2rem;
                ">
                    <!-- Reels -->
                    <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 1.5rem;">
                        <div id="reel-1" class="reel" style="
                            width: 80px;
                            height: 100px;
                            background: rgba(22, 33, 62, 0.8);
                            border: 2px solid var(--primary-gold);
                            border-radius: var(--border-radius);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 3rem;
                            font-weight: bold;
                        ">🍎</div>

                        <div id="reel-2" class="reel" style="
                            width: 80px;
                            height: 100px;
                            background: rgba(22, 33, 62, 0.8);
                            border: 2px solid var(--primary-gold);
                            border-radius: var(--border-radius);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 3rem;
                            font-weight: bold;
                        ">🍊</div>

                        <div id="reel-3" class="reel" style="
                            width: 80px;
                            height: 100px;
                            background: rgba(22, 33, 62, 0.8);
                            border: 2px solid var(--primary-gold);
                            border-radius: var(--border-radius);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 3rem;
                            font-weight: bold;
                        ">🍋</div>
                    </div>

                    <!-- Payline Indicator -->
                    <div style="text-align: center; color: var(--primary-gold); font-weight: bold; margin-bottom: 1rem;">
                        💛 PAYLINE 💛
                    </div>
                </div>

                <!-- Result Display -->
                <div id="result-display" style="
                    text-align: center;
                    padding: 1rem;
                    background: rgba(155, 89, 182, 0.2);
                    border-radius: var(--border-radius);
                    margin-bottom: 1rem;
                    display: none;
                ">
                    <h3 id="result-text" style="color: var(--primary-gold);">Result: Waiting...</h3>
                    <p id="result-message" style="color: var(--text-muted); margin-top: 0.5rem;"></p>
                </div>

                <!-- Control Buttons -->
                <div style="display: flex; gap: 1rem;">
                    <button id="spin-btn" class="btn btn-success" style="flex: 1;" onclick="spinSlots()">🎰 Spin</button>
                    <button id="reset-btn" class="btn btn-secondary" style="flex: 1;" onclick="resetSlots()">Reset</button>
                </div>
            </div>

            <!-- Betting Area -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Place Your Bet</h3>

                <!-- Bet Amount -->
                <div class="form-group">
                    <label for="bet-amount">Bet Amount (Coins):</label>
                    <input type="number" id="bet-amount" min="5" max="500" value="50" step="5">
                    <small style="color: var(--text-muted);">Min: 5 | Max: 500</small>
                </div>

                <!-- Quick Bet Buttons -->
                <div class="form-group">
                    <label>Quick Bet:</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        <button class="btn btn-primary" onclick="setBet(10)">10 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(25)">25 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(50)">50 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(100)">100 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(250)">250 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(500)">500 Coins</button>
                    </div>
                </div>

                <!-- Payout Table -->
                <div style="
                    background: rgba(155, 89, 182, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Payout Table</h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <p>🍎 🍎 🍎 = 5x Bet</p>
                        <p>🍊 🍊 🍊 = 5x Bet</p>
                        <p>🍋 🍋 🍋 = 5x Bet</p>
                        <p>⭐ ⭐ ⭐ = 10x Bet</p>
                        <p>🎁 🎁 🎁 = 20x Bet</p>
                        <p>Any 2 Match = 2x Bet</p>
                    </div>
                </div>

                <!-- Balance Display -->
                <div style="
                    background: rgba(39, 174, 96, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                    border: 2px solid var(--success);
                ">
                    <p style="margin: 0;"><strong>Your Balance:</strong></p>
                    <p id="balance-display" style="margin: 0; font-size: 1.5rem; color: var(--primary-gold);">Loading...</p>
                </div>
            </div>
        </div>

        <!-- Game Stats -->
        <section class="section">
            <h3>📊 Game Statistics</h3>
            <div class="grid grid-4">
                <div class="card" style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎮</div>
                    <p style="color: var(--text-muted); margin: 0;">Total Spins</p>
                    <p id="total-spins" style="font-size: 1.5rem; color: var(--primary-gold); margin: 0;">0</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">✅</div>
                    <p style="color: var(--text-muted); margin: 0;">Wins</p>
                    <p id="total-wins" style="font-size: 1.5rem; color: var(--success); margin: 0;">0</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">💰</div>
                    <p style="color: var(--text-muted); margin: 0;">Total Bet</p>
                    <p id="total-bet" style="font-size: 1.5rem; color: var(--primary-gold); margin: 0;">0</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏆</div>
                    <p style="color: var(--text-muted); margin: 0;">Total Won</p>
                    <p id="total-won" style="font-size: 1.5rem; color: var(--success); margin: 0;">0</p>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
const symbols = ['🍎', '🍊', '🍋', '⭐', '🎁'];
let isSpinning = false;

function setBet(amount) {
    document.getElementById('bet-amount').value = amount;
}

function spinSlots() {
    const betAmount = parseInt(document.getElementById('bet-amount').value);
    const balance = parseInt(document.getElementById('balance-display').textContent);

    if (betAmount > balance) {
        Toast.error('Insufficient balance!');
        return;
    }

    if (isSpinning) return;

    isSpinning = true;
    document.getElementById('spin-btn').disabled = true;

    // Spin animation
    const reels = [
        document.getElementById('reel-1'),
        document.getElementById('reel-2'),
        document.getElementById('reel-3')
    ];

    let spins = [0, 0, 0];
    const spinInterval = setInterval(() => {
        reels.forEach((reel, index) => {
            reel.textContent = symbols[Math.floor(Math.random() * symbols.length)];
            spins[index]++;
        });
    }, 100);

    // Stop spinning after 2 seconds
    setTimeout(() => {
        clearInterval(spinInterval);
        
        // Get final results
        const results = [
            symbols[Math.floor(Math.random() * symbols.length)],
            symbols[Math.floor(Math.random() * symbols.length)],
            symbols[Math.floor(Math.random() * symbols.length)]
        ];

        reels.forEach((reel, index) => {
            reel.textContent = results[index];
        });

        // Check for win
        const isWin = checkSlotWin(results);
        let winAmount = 0;

        if (isWin) {
            winAmount = calculateSlotWin(results, betAmount);
            displaySlotResult(true, results, winAmount);
            soundManager.playWin();
            updateBalance(winAmount);
        } else {
            displaySlotResult(false, results, 0);
            soundManager.playLose();
            updateBalance(-betAmount);
        }

        isSpinning = false;
        document.getElementById('spin-btn').disabled = false;
    }, 2000);
}

function checkSlotWin(results) {
    // Check for three of a kind
    if (results[0] === results[1] && results[1] === results[2]) {
        return true;
    }
    // Check for two of a kind
    if (results[0] === results[1] || results[1] === results[2] || results[0] === results[2]) {
        return true;
    }
    return false;
}

function calculateSlotWin(results, betAmount) {
    // Three of a kind
    if (results[0] === results[1] && results[1] === results[2]) {
        if (results[0] === '🎁') return betAmount * 20;
        if (results[0] === '⭐') return betAmount * 10;
        return betAmount * 5;
    }
    // Two of a kind
    return betAmount * 2;
}

function displaySlotResult(isWin, results, winAmount) {
    const resultDisplay = document.getElementById('result-display');
    const resultText = document.getElementById('result-text');
    const resultMessage = document.getElementById('result-message');

    if (isWin) {
        resultText.textContent = `🎉 You Won! ${winAmount} Coins!`;
        resultText.style.color = 'var(--success)';
        resultMessage.textContent = `${results.join(' ')} - Congratulations!`;
    } else {
        resultText.textContent = `😔 No Match. Try Again!`;
        resultText.style.color = 'var(--danger)';
        resultMessage.textContent = `${results.join(' ')} - Better luck next time!`;
    }

    resultDisplay.style.display = 'block';
}

function updateBalance(change) {
    const balanceDisplay = document.getElementById('balance-display');
    let currentBalance = parseInt(balanceDisplay.textContent);
    currentBalance += change;
    balanceDisplay.textContent = currentBalance;
}

function resetSlots() {
    document.getElementById('result-display').style.display = 'none';
    document.getElementById('reel-1').textContent = '🍎';
    document.getElementById('reel-2').textContent = '🍊';
    document.getElementById('reel-3').textContent = '🍋';
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    coinDisplay.fetchAndUpdate();
    document.getElementById('balance-display').textContent = document.querySelector('.coin-display').textContent.match(/\d+/)[0];
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
