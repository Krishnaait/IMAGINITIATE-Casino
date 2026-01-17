<?php
/**
 * Roulette Game
 */

require_once __DIR__ . '/../../includes/init.php';

$pageTitle = 'Roulette - IMAGINITIATE Social Casino';
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
    <div class="game-container">
        <!-- Game Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>🎡 Roulette</h1>
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-secondary">← Back to Games</a>
        </div>

        <!-- Game Info -->
        <div class="alert alert-info" style="margin-bottom: 2rem;">
            <strong>How to Play:</strong> Choose a number (0-36), color (Red/Black), or range (1-18, 19-36, Even/Odd). 
            Place your bet and spin the wheel. If the ball lands on your choice, you win!
        </div>

        <div class="grid grid-2" style="margin-bottom: 2rem;">
            <!-- Game Area -->
            <div class="card">
                <h3 style="text-align: center; margin-bottom: 2rem;">Spin the Wheel</h3>
                
                <!-- Roulette Wheel -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div id="roulette-wheel" style="
                        width: 300px;
                        height: 300px;
                        border-radius: 50%;
                        background: conic-gradient(
                            red 0deg 18.9deg,
                            black 18.9deg 37.8deg,
                            red 37.8deg 56.7deg,
                            black 56.7deg 75.6deg,
                            red 75.6deg 94.5deg,
                            black 94.5deg 113.4deg,
                            red 113.4deg 132.3deg,
                            black 132.3deg 151.2deg,
                            red 151.2deg 170.1deg,
                            black 170.1deg 189deg,
                            red 189deg 207.9deg,
                            black 207.9deg 226.8deg,
                            red 226.8deg 245.7deg,
                            black 245.7deg 264.6deg,
                            red 264.6deg 283.5deg,
                            black 283.5deg 302.4deg,
                            red 302.4deg 321.3deg,
                            black 321.3deg 340.2deg,
                            red 340.2deg 360deg
                        );
                        margin: 0 auto;
                        border: 5px solid var(--primary-gold);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: bold;
                        color: var(--primary-gold);
                        font-size: 2rem;
                        position: relative;
                        box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
                    " class="animate-spin" id="wheel">
                        🎡
                    </div>
                    <div style="
                        width: 0;
                        height: 0;
                        border-left: 15px solid transparent;
                        border-right: 15px solid transparent;
                        border-top: 20px solid var(--primary-gold);
                        margin: -20px auto 0;
                        position: relative;
                        z-index: 10;
                    "></div>
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
                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button id="spin-btn" class="btn btn-success" style="flex: 1;" onclick="spinRoulette()">🎯 Spin Wheel</button>
                    <button id="reset-btn" class="btn btn-secondary" style="flex: 1;" onclick="resetRoulette()" style="display: none;">Reset Game</button>
                </div>
            </div>

            <!-- Betting Area -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Place Your Bet</h3>

                <!-- Bet Amount -->
                <div class="form-group">
                    <label for="bet-amount">Bet Amount (Coins):</label>
                    <input type="number" id="bet-amount" min="10" max="1000" value="100" step="10">
                    <small style="color: var(--text-muted);">Min: 10 | Max: 1000</small>
                </div>

                <!-- Bet Type Selection -->
                <div class="form-group">
                    <label>Choose Bet Type:</label>
                    <div style="margin-top: 0.5rem;">
                        <button class="btn btn-secondary" style="width: 100%; margin-bottom: 0.5rem; text-align: left;" onclick="selectBetType('number')">
                            🔢 Specific Number (0-36)
                        </button>
                        <button class="btn btn-secondary" style="width: 100%; margin-bottom: 0.5rem; text-align: left;" onclick="selectBetType('color')">
                            🎨 Color (Red/Black)
                        </button>
                        <button class="btn btn-secondary" style="width: 100%; text-align: left;" onclick="selectBetType('range')">
                            📊 Range (1-18, 19-36, Even/Odd)
                        </button>
                    </div>
                </div>

                <!-- Number Selection -->
                <div id="number-selection" class="form-group" style="display: none;">
                    <label>Select Number:</label>
                    <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.5rem; margin-top: 0.5rem;">
                        <?php for ($i = 0; $i <= 36; $i++): ?>
                            <button class="btn btn-primary" style="padding: 0.5rem; font-size: 0.9rem;" onclick="selectNumber(<?php echo $i; ?>)">
                                <?php echo $i; ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Color Selection -->
                <div id="color-selection" class="form-group" style="display: none;">
                    <label>Select Color:</label>
                    <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                        <button class="btn btn-primary" style="flex: 1; background: red;" onclick="selectColor('red')">🔴 Red</button>
                        <button class="btn btn-primary" style="flex: 1; background: black;" onclick="selectColor('black')">⚫ Black</button>
                    </div>
                </div>

                <!-- Range Selection -->
                <div id="range-selection" class="form-group" style="display: none;">
                    <label>Select Range:</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: 0.5rem;">
                        <button class="btn btn-primary" onclick="selectRange('1-18')">1-18</button>
                        <button class="btn btn-primary" onclick="selectRange('19-36')">19-36</button>
                        <button class="btn btn-primary" onclick="selectRange('even')">Even</button>
                        <button class="btn btn-primary" onclick="selectRange('odd')">Odd</button>
                    </div>
                </div>

                <!-- Selected Bet Display -->
                <div id="selected-bet" style="
                    background: rgba(155, 89, 182, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                    display: none;
                ">
                    <p><strong>Selected Bet:</strong> <span id="bet-display">None</span></p>
                    <p><strong>Bet Amount:</strong> <span id="amount-display">0</span> Coins</p>
                    <p><strong>Potential Win:</strong> <span id="win-display">0</span> Coins</p>
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
                    <p style="color: var(--text-muted); margin: 0;">Total Plays</p>
                    <p id="total-plays" style="font-size: 1.5rem; color: var(--primary-gold); margin: 0;">0</p>
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
let currentBet = null;
let currentBetType = null;
let isSpinning = false;

function selectBetType(type) {
    document.getElementById('number-selection').style.display = 'none';
    document.getElementById('color-selection').style.display = 'none';
    document.getElementById('range-selection').style.display = 'none';

    if (type === 'number') {
        document.getElementById('number-selection').style.display = 'block';
    } else if (type === 'color') {
        document.getElementById('color-selection').style.display = 'block';
    } else if (type === 'range') {
        document.getElementById('range-selection').style.display = 'block';
    }

    currentBetType = type;
}

function selectNumber(num) {
    currentBet = { type: 'number', value: num };
    updateBetDisplay();
}

function selectColor(color) {
    currentBet = { type: 'color', value: color };
    updateBetDisplay();
}

function selectRange(range) {
    currentBet = { type: 'range', value: range };
    updateBetDisplay();
}

function updateBetDisplay() {
    const betAmount = parseInt(document.getElementById('bet-amount').value);
    let betText = '';
    let odds = 1;

    if (currentBet.type === 'number') {
        betText = `Number ${currentBet.value}`;
        odds = 36;
    } else if (currentBet.type === 'color') {
        betText = `${currentBet.value.charAt(0).toUpperCase() + currentBet.value.slice(1)} Color`;
        odds = 2;
    } else if (currentBet.type === 'range') {
        betText = currentBet.value.toUpperCase();
        odds = 2;
    }

    const potentialWin = betAmount * odds;

    document.getElementById('bet-display').textContent = betText;
    document.getElementById('amount-display').textContent = betAmount;
    document.getElementById('win-display').textContent = potentialWin;
    document.getElementById('selected-bet').style.display = 'block';
}

function spinRoulette() {
    if (!currentBet) {
        Toast.warning('Please select a bet first!');
        return;
    }

    const betAmount = parseInt(document.getElementById('bet-amount').value);
    const balance = parseInt(document.getElementById('balance-display').textContent);

    if (betAmount > balance) {
        Toast.error('Insufficient balance!');
        return;
    }

    isSpinning = true;
    document.getElementById('spin-btn').disabled = true;

    // Simulate wheel spin
    const wheel = document.getElementById('wheel');
    wheel.style.animation = 'none';
    setTimeout(() => {
        wheel.style.animation = 'spin 3s linear infinite';
    }, 10);

    // Simulate result
    setTimeout(() => {
        const result = Math.floor(Math.random() * 37);
        const isWin = checkWin(result);

        wheel.style.animation = 'none';
        wheel.style.transform = `rotate(${result * 9.73}deg)`;

        displayResult(result, isWin, betAmount);
        isSpinning = false;
        document.getElementById('spin-btn').disabled = false;
    }, 3000);
}

function checkWin(result) {
    if (currentBet.type === 'number') {
        return result === currentBet.value;
    } else if (currentBet.type === 'color') {
        const redNumbers = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];
        const isRed = redNumbers.includes(result);
        return (currentBet.value === 'red' && isRed) || (currentBet.value === 'black' && !isRed);
    } else if (currentBet.type === 'range') {
        if (currentBet.value === '1-18') return result >= 1 && result <= 18;
        if (currentBet.value === '19-36') return result >= 19 && result <= 36;
        if (currentBet.value === 'even') return result > 0 && result % 2 === 0;
        if (currentBet.value === 'odd') return result > 0 && result % 2 !== 0;
    }
    return false;
}

function displayResult(result, isWin, betAmount) {
    const resultDisplay = document.getElementById('result-display');
    const resultText = document.getElementById('result-text');
    const resultMessage = document.getElementById('result-message');

    let odds = 1;
    if (currentBet.type === 'number') odds = 36;
    else if (currentBet.type === 'color' || currentBet.type === 'range') odds = 2;

    if (isWin) {
        const winAmount = betAmount * odds;
        resultText.textContent = `🎉 You Won! ${winAmount} Coins!`;
        resultText.style.color = 'var(--success)';
        resultMessage.textContent = `The ball landed on ${result}. Your bet was correct!`;
        soundManager.playWin();
        updateBalance(winAmount);
    } else {
        resultText.textContent = `😔 You Lost! Better luck next time.`;
        resultText.style.color = 'var(--danger)';
        resultMessage.textContent = `The ball landed on ${result}. Your bet was not correct.`;
        soundManager.playLose();
        updateBalance(-betAmount);
    }

    resultDisplay.style.display = 'block';
}

function updateBalance(change) {
    const balanceDisplay = document.getElementById('balance-display');
    let currentBalance = parseInt(balanceDisplay.textContent);
    currentBalance += change;
    balanceDisplay.textContent = currentBalance;
}

function resetRoulette() {
    currentBet = null;
    currentBetType = null;
    document.getElementById('result-display').style.display = 'none';
    document.getElementById('selected-bet').style.display = 'none';
    document.getElementById('number-selection').style.display = 'none';
    document.getElementById('color-selection').style.display = 'none';
    document.getElementById('range-selection').style.display = 'none';
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    coinDisplay.fetchAndUpdate();
    document.getElementById('balance-display').textContent = document.querySelector('.coin-display').textContent.match(/\d+/)[0];
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
