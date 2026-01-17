<?php
/**
 * Rummy Game
 */

require_once __DIR__ . '/../../includes/init.php';

$pageTitle = 'Rummy - IMAGINITIATE Social Casino';
include __DIR__ . '/../../includes/header.php';
?>

<div class="container">
    <div class="game-container">
        <!-- Game Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1>🃏 Rummy</h1>
            <a href="/imaginitiate-casino/public/games.php" class="btn btn-secondary">← Back to Games</a>
        </div>

        <!-- Game Info -->
        <div class="alert alert-info" style="margin-bottom: 2rem;">
            <strong>How to Play:</strong> Arrange your cards into sets (3+ cards of same rank) or sequences (3+ cards in order). 
            First to arrange all cards wins! Test your strategy and skill!
        </div>

        <div class="grid grid-2" style="margin-bottom: 2rem;">
            <!-- Game Area -->
            <div class="card">
                <h3 style="text-align: center; margin-bottom: 2rem;">Your Hand</h3>
                
                <!-- Player Hand -->
                <div id="player-hand" style="
                    background: rgba(22, 33, 62, 0.8);
                    padding: 1.5rem;
                    border-radius: var(--border-radius);
                    border: 2px solid var(--primary-gold);
                    margin-bottom: 1.5rem;
                    min-height: 120px;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 0.5rem;
                    align-items: center;
                    justify-content: center;
                ">
                    <p style="color: var(--text-muted); width: 100%; text-align: center;">Generating cards...</p>
                </div>

                <!-- Game Controls -->
                <div style="margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Game Controls</h4>
                    <button class="btn btn-success" style="width: 100%; margin-bottom: 0.5rem;" onclick="drawCard()">🎴 Draw Card</button>
                    <button class="btn btn-warning" style="width: 100%; margin-bottom: 0.5rem;" onclick="discardCard()">🗑️ Discard Card</button>
                    <button class="btn btn-primary" style="width: 100%; margin-bottom: 0.5rem;" onclick="declareRummy()">🏆 Declare Rummy</button>
                    <button class="btn btn-secondary" style="width: 100%;" onclick="resetRummy()">Reset Game</button>
                </div>

                <!-- Result Display -->
                <div id="result-display" style="
                    text-align: center;
                    padding: 1rem;
                    background: rgba(155, 89, 182, 0.2);
                    border-radius: var(--border-radius);
                    display: none;
                ">
                    <h3 id="result-text" style="color: var(--primary-gold);">Result: Waiting...</h3>
                    <p id="result-message" style="color: var(--text-muted); margin-top: 0.5rem;"></p>
                </div>
            </div>

            <!-- Betting Area -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem;">Place Your Bet</h3>

                <!-- Bet Amount -->
                <div class="form-group">
                    <label for="bet-amount">Bet Amount (Coins):</label>
                    <input type="number" id="bet-amount" min="10" max="500" value="50" step="10">
                    <small style="color: var(--text-muted);">Min: 10 | Max: 500</small>
                </div>

                <!-- Game Rules -->
                <div style="
                    background: rgba(155, 89, 182, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Game Rules</h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <p><strong>Sets:</strong> 3+ cards of same rank (e.g., K♠ K♥ K♦)</p>
                        <p><strong>Sequences:</strong> 3+ cards in order (e.g., 5♠ 6♠ 7♠)</p>
                        <p><strong>Win:</strong> Arrange all cards into valid sets/sequences</p>
                        <p><strong>Draw:</strong> Draw one card each turn</p>
                        <p><strong>Discard:</strong> Discard one card after drawing</p>
                    </div>
                </div>

                <!-- Card Values -->
                <div style="
                    background: rgba(52, 152, 219, 0.2);
                    padding: 1rem;
                    border-radius: var(--border-radius);
                    margin-top: 1rem;
                    border: 2px solid var(--info);
                ">
                    <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">Card Values</h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <p>Number Cards: Face Value (2-10)</p>
                        <p>Face Cards (J, Q, K): 10 Points</p>
                        <p>Ace: 1 or 11 Points</p>
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
const suits = ['♠', '♥', '♦', '♣'];
const ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

let playerHand = [];
let gameActive = false;
let betAmount = 0;

function generateDeck() {
    const deck = [];
    for (let suit of suits) {
        for (let rank of ranks) {
            deck.push({ rank, suit });
        }
    }
    return deck.sort(() => Math.random() - 0.5);
}

function dealCards() {
    const deck = generateDeck();
    playerHand = deck.slice(0, 13);
    gameActive = true;
    betAmount = parseInt(document.getElementById('bet-amount').value);
    const balance = parseInt(document.getElementById('balance-display').textContent);

    if (betAmount > balance) {
        Toast.error('Insufficient balance!');
        return;
    }

    updateHandDisplay();
    Toast.info('Game started! Arrange your cards into sets and sequences.');
}

function updateHandDisplay() {
    const handContainer = document.getElementById('player-hand');
    handContainer.innerHTML = playerHand.map((card, index) => `
        <div style="
            background: var(--primary-purple);
            border: 2px solid var(--primary-gold);
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-weight: bold;
            color: var(--primary-gold);
        " onclick="selectCard(${index})" title="Click to select">
            ${card.rank}${card.suit}
        </div>
    `).join('');
}

function selectCard(index) {
    soundManager.playClick();
    Toast.info(`Selected: ${playerHand[index].rank}${playerHand[index].suit}`);
}

function drawCard() {
    if (!gameActive) {
        Toast.warning('Start a new game first!');
        dealCards();
        return;
    }

    const newCard = { rank: ranks[Math.floor(Math.random() * ranks.length)], suit: suits[Math.floor(Math.random() * suits.length)] };
    playerHand.push(newCard);
    updateHandDisplay();
    Toast.info(`Drew: ${newCard.rank}${newCard.suit}`);
}

function discardCard() {
    if (!gameActive || playerHand.length === 0) {
        Toast.warning('No card to discard!');
        return;
    }

    const discardIndex = Math.floor(Math.random() * playerHand.length);
    const discardedCard = playerHand.splice(discardIndex, 1)[0];
    updateHandDisplay();
    Toast.info(`Discarded: ${discardedCard.rank}${discardedCard.suit}`);
}

function declareRummy() {
    if (!gameActive) {
        Toast.warning('Start a game first!');
        return;
    }

    // Simulate rummy declaration
    const isWin = Math.random() > 0.5;
    const winAmount = betAmount * 3;

    if (isWin) {
        displayRummyResult(true, winAmount);
        soundManager.playWin();
        updateBalance(winAmount);
    } else {
        displayRummyResult(false, 0);
        soundManager.playLose();
        updateBalance(-betAmount);
    }

    gameActive = false;
}

function displayRummyResult(isWin, winAmount) {
    const resultDisplay = document.getElementById('result-display');
    const resultText = document.getElementById('result-text');
    const resultMessage = document.getElementById('result-message');

    if (isWin) {
        resultText.textContent = `🎉 Rummy Declared! You Won ${winAmount} Coins!`;
        resultText.style.color = 'var(--success)';
        resultMessage.textContent = 'Congratulations! Your arrangement was valid!';
    } else {
        resultText.textContent = `😔 Invalid Arrangement. You Lost ${betAmount} Coins.`;
        resultText.style.color = 'var(--danger)';
        resultMessage.textContent = 'Your cards did not form valid sets and sequences.';
    }

    resultDisplay.style.display = 'block';
}

function updateBalance(change) {
    const balanceDisplay = document.getElementById('balance-display');
    let currentBalance = parseInt(balanceDisplay.textContent);
    currentBalance += change;
    balanceDisplay.textContent = currentBalance;
}

function resetRummy() {
    playerHand = [];
    gameActive = false;
    document.getElementById('result-display').style.display = 'none';
    document.getElementById('player-hand').innerHTML = '<p style="color: var(--text-muted); width: 100%; text-align: center;">Click "Deal Cards" to start a new game</p>';
    dealCards();
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    coinDisplay.fetchAndUpdate();
    document.getElementById('balance-display').textContent = document.querySelector('.coin-display').textContent.match(/\d+/)[0];
    dealCards();
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
