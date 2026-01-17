/**
 * IMAGINITIATE Social Casino - Main JavaScript
 */

// Sound Manager
class SoundManager {
    constructor() {
        this.enabled = localStorage.getItem('soundEnabled') !== 'false';
        this.updateSoundButton();
    }

    toggle() {
        this.enabled = !this.enabled;
        localStorage.setItem('soundEnabled', this.enabled);
        this.updateSoundButton();
    }

    updateSoundButton() {
        const btn = document.querySelector('.sound-toggle');
        if (btn) {
            if (this.enabled) {
                btn.textContent = '🔊 Sound';
                btn.classList.remove('muted');
            } else {
                btn.textContent = '🔇 Muted';
                btn.classList.add('muted');
            }
        }
    }

    play(soundName) {
        if (!this.enabled) return;
        
        // Create audio element
        const audio = new Audio(`/imaginitiate-casino/assets/sounds/${soundName}.mp3`);
        audio.volume = 0.5;
        audio.play().catch(e => console.log('Sound play error:', e));
    }

    playClick() {
        this.play('click');
    }

    playWin() {
        this.play('win');
    }

    playLose() {
        this.play('lose');
    }

    playBonus() {
        this.play('bonus');
    }
}

// Initialize Sound Manager
const soundManager = new SoundManager();

// Mobile Menu Toggle
function initMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            soundManager.playClick();
            nav.classList.toggle('active');
        });

        // Close menu when link is clicked
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('active');
            });
        });
    }
}

// Modal Management
class Modal {
    constructor(modalId) {
        this.modal = document.getElementById(modalId);
        this.closeBtn = this.modal?.querySelector('.modal-close');
        this.setupListeners();
    }

    setupListeners() {
        if (!this.modal) return;

        this.closeBtn?.addEventListener('click', () => this.close());

        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.close();
            }
        });
    }

    open() {
        if (this.modal) {
            this.modal.classList.add('active');
            soundManager.playClick();
        }
    }

    close() {
        if (this.modal) {
            this.modal.classList.remove('active');
        }
    }
}

// Toast Notification System
class Toast {
    static show(message, type = 'info', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type}`;
        toast.innerHTML = `<span>${message}</span>`;
        toast.style.position = 'fixed';
        toast.style.top = '20px';
        toast.style.right = '20px';
        toast.style.zIndex = '3000';
        toast.style.minWidth = '300px';
        toast.style.animation = 'slideDown 0.3s ease';

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    static success(message) {
        this.show(message, 'success');
    }

    static error(message) {
        this.show(message, 'danger');
    }

    static warning(message) {
        this.show(message, 'warning');
    }

    static info(message) {
        this.show(message, 'info');
    }
}

// Coin Display Manager
class CoinDisplay {
    constructor() {
        this.display = document.querySelector('.coin-display');
        this.updateInterval = null;
    }

    update(coins) {
        if (this.display) {
            this.display.innerHTML = `💰 ${this.formatCoins(coins)} Coins`;
            this.animateUpdate();
        }
    }

    formatCoins(coins) {
        return coins.toLocaleString('en-IN');
    }

    animateUpdate() {
        if (this.display) {
            this.display.style.animation = 'none';
            setTimeout(() => {
                this.display.style.animation = 'pulse 0.5s ease';
            }, 10);
        }
    }

    startAutoUpdate() {
        this.updateInterval = setInterval(() => {
            this.fetchAndUpdate();
        }, 5000);
    }

    stopAutoUpdate() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
        }
    }

    async fetchAndUpdate() {
        try {
            const response = await fetch('/imaginitiate-casino/api/get-balance.php');
            const data = await response.json();
            if (data.success) {
                this.update(data.balance);
            }
        } catch (error) {
            console.error('Error fetching balance:', error);
        }
    }
}

const coinDisplay = new CoinDisplay();

// Claim Daily Bonus
async function claimDailyBonus() {
    try {
        const response = await fetch('/imaginitiate-casino/api/claim-bonus.php', {
            method: 'POST'
        });
        const data = await response.json();

        if (data.success) {
            Toast.success(`✨ ${data.message} +${data.amount} Coins!`);
            soundManager.playBonus();
            coinDisplay.fetchAndUpdate();
        } else {
            Toast.warning(data.message);
        }
    } catch (error) {
        Toast.error('Error claiming bonus');
        console.error(error);
    }
}

// Reset Credits
async function resetCredits() {
    if (!confirm('Reset your credits to 500? This action cannot be undone.')) {
        return;
    }

    try {
        const response = await fetch('/imaginitiate-casino/api/reset-credits.php', {
            method: 'POST'
        });
        const data = await response.json();

        if (data.success) {
            Toast.success(`✨ ${data.message} +${data.amount} Coins!`);
            soundManager.playBonus();
            coinDisplay.fetchAndUpdate();
        } else {
            Toast.error(data.message);
        }
    } catch (error) {
        Toast.error('Error resetting credits');
        console.error(error);
    }
}

// Free Top-Up
async function freeTopUp() {
    try {
        const response = await fetch('/imaginitiate-casino/api/free-topup.php', {
            method: 'POST'
        });
        const data = await response.json();

        if (data.success) {
            Toast.success(`✨ ${data.message} +${data.amount} Coins!`);
            soundManager.playBonus();
            coinDisplay.fetchAndUpdate();
        } else {
            Toast.warning(data.message);
        }
    } catch (error) {
        Toast.error('Error with top-up');
        console.error(error);
    }
}

// Accordion Functionality
function initAccordions() {
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            soundManager.playClick();
            const accordion = header.parentElement;
            const isActive = accordion.classList.contains('active');

            // Close all accordions
            document.querySelectorAll('.accordion').forEach(acc => {
                acc.classList.remove('active');
            });

            // Open clicked accordion
            if (!isActive) {
                accordion.classList.add('active');
            }
        });
    });
}

// Initialize Page
document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initAccordions();
    coinDisplay.startAutoUpdate();

    // Sound toggle button
    const soundToggle = document.querySelector('.sound-toggle');
    if (soundToggle) {
        soundToggle.addEventListener('click', () => {
            soundManager.toggle();
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});

// Prevent accidental page refresh
window.addEventListener('beforeunload', (e) => {
    // Only show warning if user is in a game
    const gameContainer = document.querySelector('.game-container');
    if (gameContainer) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
