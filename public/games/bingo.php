<?php
/**
 * Bingo Game
 */

require_once __DIR__ . '/../../includes/init.php';

$pageTitle = 'Bingo - IMAGINITIATE Social Casino';
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
    <div class="game-container">
        <!-- Game Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>🎲 Bingo</h1>
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-secondary">← Back to Games</a>
        </div>

        <!-- Game Info -->
        <div class="alert alert-info" style="margin-bottom: 2rem;">
            <strong>How to Play:</strong> Numbers are called randomly. Mark matching numbers on your card. 
            Complete a line or full card to win! Multiple patterns = multiple wins!
        </div>

        <div class="grid grid-2" style="margin-bottom: 2rem;">
            <!-- Game Area -->
            <div class="card">
                <h3 style="text-align: center; margin-bottom: 2rem;">Bingo Card</h3>
                
                <!-- Bingo Card -->
                <div id="bingo-card" style="
                    background: rgba(22, 33, 62, 0.8);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    border: 3px solid var(--primary-gold);
                    margin-bottom: 1.5rem;
                    display: grid;
                    grid-template-columns: repeat(5, 1fr);
                    gap: 0.5rem;
                ">
                    <!-- Bingo numbers will be generated here -->
                </div>

                <!-- Called Numbers Display -->
                <div style="
                    background: rgba(155, 89, 182, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-bottom: 1.5rem;
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 0.5rem;">Called Numbers:</h4>
                    <div id="called-numbers" style="
                        display: flex;
                        flex-wrap: wrap;
                        gap: 0.5rem;
                        min-height: 40px;
                        align-items: center;
                    ">
                        <p style="color: var(--text-muted);">Waiting for numbers...</p>
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
                    <button id="call-btn" class="btn btn-success" style="flex: 1;" onclick="callNumber()">📢 Call Number</button>
                    <button id="reset-btn" class="btn btn-secondary" style="flex: 1;" onclick="resetBingo()">Reset Game</button>
                </div>
            </div>

            <!-- Betting Area -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Place Your Bet</h3>

                <!-- Bet Amount -->
                <div class="form-group">
                    <label for="bet-amount">Bet Amount (Coins):</label>
                    <input type="number" id="bet-amount" min="5" max="200" value="25" step="5">
                    <small style="color: var(--text-muted);">Min: 5 | Max: 200</small>
                </div>

                <!-- Quick Bet Buttons -->
                <div class="form-group">
                    <label>Quick Bet:</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                        <button class="btn btn-primary" onclick="setBet(5)">5 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(10)">10 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(25)">25 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(50)">50 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(100)">100 Coins</button>
                        <button class="btn btn-primary" onclick="setBet(200)">200 Coins</button>
                    </div>
                </div>

                <!-- Win Patterns -->
                <div style="
                    background: rgba(155, 89, 182, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Win Patterns</h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <p>✓ Horizontal Line = 2x Bet</p>
                        <p>✓ Vertical Line = 2x Bet</p>
                        <p>✓ Diagonal Line = 3x Bet</p>
                        <p>✓ Four Corners = 4x Bet</p>
                        <p>✓ Full Card = 10x Bet</p>
                    </div>
                </div>

                <!-- Game Stats -->
                <div style="
                    background: rgba(52, 152, 219, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                    border: 2px solid var(--info);
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Game Info</h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <p>Numbers: 1-75</p>
                        <p>Card Size: 5x5</p>
                        <p>Center: FREE</p>
                        <p>Multiple Wins Possible</p>
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
                    <p style="color: var(--text-muted); margin: 0;">Total Games</p>
                    <p id="total-games" style="font-size: 1.5rem; color: var(--primary-gold); margin: 0;">0</p>
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
let bingoCard = [];
let calledNumbers = [];
let gameActive = false;
let betAmount = 0;

function generateBingoCard() {
    const card = [];
    for (let i = 0; i < 25; i++) {
        if (i === 12) {
            card.push(0); // FREE space in center
        } else {
            let num;
            do {
                num = Math.floor(Math.random() * 75) + 1;
            } while (card.includes(num));
            card.push(num);
        }
    }
    return card;
}

function initBingoGame() {
    bingoCard = generateBingoCard();
    calledNumbers = [];
    gameActive = true;
    betAmount = parseInt(document.getElementById('bet-amount').value);
    const balance = parseInt(document.getElementById('balance-display').textContent);

    if (betAmount > balance) {
        Toast.error('Insufficient balance!');
        return;
    }

    displayBingoCard();
    Toast.info('Game started! Numbers will be called randomly.');
}

function displayBingoCard() {
    const cardContainer = document.getElementById('bingo-card');
    cardContainer.innerHTML = bingoCard.map((num, index) => `
        <div style="
            background: ${calledNumbers.includes(num) ? 'var(--success)' : 'var(--primary-purple)'};
            border: 2px solid var(--primary-gold);
            padding: 1rem;
            border-radius: var(--border-radius);
            text-align: center;
            font-weight: bold;
            color: var(--primary-gold);
            cursor: pointer;
            font-size: 1.2rem;
            transition: var(--transition);
        " onclick="markNumber(${num})">
            ${num === 0 ? 'FREE' : num}
        </div>
    `).join('');
}

function markNumber(num) {
    if (num === 0 || calledNumbers.includes(num)) {
        soundManager.playClick();
    }
}

function callNumber() {
    if (!gameActive) {
        Toast.warning('Start a new game first!');
        initBingoGame();
        return;
    }

    let newNumber;
    do {
        newNumber = Math.floor(Math.random() * 75) + 1;
    } while (calledNumbers.includes(newNumber));

    calledNumbers.push(newNumber);
    displayBingoCard();
    updateCalledNumbers();
    soundManager.playClick();

    // Check for win
    checkBingoWin();
}

function updateCalledNumbers() {
    const calledDisplay = document.getElementById('called-numbers');
    calledDisplay.innerHTML = calledNumbers.map(num => `
        <span style="
            background: var(--primary-gold);
            color: var(--dark-bg);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-weight: bold;
        ">${num}</span>
    `).join('');
}

function checkBingoWin() {
    // Check horizontal
    for (let row = 0; row < 5; row++) {
        let complete = true;
        for (let col = 0; col < 5; col++) {
            const num = bingoCard[row * 5 + col];
            if (num !== 0 && !calledNumbers.includes(num)) {
                complete = false;
                break;
            }
        }
        if (complete) {
            displayBingoResult(true, 'Horizontal Line', betAmount * 2);
            return;
        }
    }

    // Check vertical
    for (let col = 0; col < 5; col++) {
        let complete = true;
        for (let row = 0; row < 5; row++) {
            const num = bingoCard[row * 5 + col];
            if (num !== 0 && !calledNumbers.includes(num)) {
                complete = false;
                break;
            }
        }
        if (complete) {
            displayBingoResult(true, 'Vertical Line', betAmount * 2);
            return;
        }
    }

    // Check full card
    let fullCard = true;
    for (let i = 0; i < 25; i++) {
        const num = bingoCard[i];
        if (num !== 0 && !calledNumbers.includes(num)) {
            fullCard = false;
            break;
        }
    }
    if (fullCard) {
        displayBingoResult(true, 'Full Card!', betAmount * 10);
        return;
    }
}

function displayBingoResult(isWin, pattern, winAmount) {
    const resultDisplay = document.getElementById('result-display');
    const resultText = document.getElementById('result-text');
    const resultMessage = document.getElementById('result-message');

    if (isWin) {
        resultText.textContent = `🎉 BINGO! You Won ${winAmount} Coins!`;
        resultText.style.color = 'var(--success)';
        resultMessage.textContent = `Pattern: ${pattern}`;
        soundManager.playWin();
        updateBalance(winAmount);
    }

    resultDisplay.style.display = 'block';
    gameActive = false;
}

function setBet(amount) {
    document.getElementById('bet-amount').value = amount;
}

function updateBalance(change) {
    const balanceDisplay = document.getElementById('balance-display');
    let currentBalance = parseInt(balanceDisplay.textContent);
    currentBalance += change;
    balanceDisplay.textContent = currentBalance;
}

function resetBingo() {
    bingoCard = [];
    calledNumbers = [];
    gameActive = false;
    document.getElementById('result-display').style.display = 'none';
    document.getElementById('called-numbers').innerHTML = '<p style="color: var(--text-muted);">Waiting for numbers...</p>';
    initBingoGame();
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    coinDisplay.fetchAndUpdate();
    document.getElementById('balance-display').textContent = document.querySelector('.coin-display').textContent.match(/\d+/)[0];
    initBingoGame();
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
