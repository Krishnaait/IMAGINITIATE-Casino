# IMAGINITIATE - Social Casino Platform

## 🎮 Project Overview

**IMAGINITIATE** is a fully functional, free-to-play social casino website built with **HTML, CSS, JavaScript, and PHP**. It provides an entertaining gaming experience with virtual coins that have no real-world value, ensuring complete compliance with gaming regulations while delivering an engaging user experience.

### Key Features

- ✅ **100% Free-to-Play** - No real money, no purchases, no withdrawals
- ✅ **4 Exciting Games** - Roulette, Slots, Rummy, and Bingo with detailed explanations
- ✅ **Virtual Coin System** - 1000 initial coins + 200 daily bonus + free top-up
- ✅ **No Registration Required** - Direct access with session-based gameplay
- ✅ **Fully Responsive** - Works perfectly on desktop, tablet, and mobile devices
- ✅ **Beautiful Graphics** - Modern design with smooth animations and sound effects
- ✅ **Responsible Gaming** - Comprehensive guidelines and resources
- ✅ **Complete Compliance** - Terms, Privacy Policy, Disclaimer, and Responsible Gaming pages
- ✅ **Google Ads Friendly** - Fully compliant with advertising policies

---

## 📁 Project Structure

```
imaginitiate-casino/
├── config/
│   └── config.php              # Database and application configuration
├── includes/
│   ├── init.php                # Main initialization file
│   ├── Database.php            # Database connection and helpers
│   ├── SessionManager.php      # Session and coin management
│   ├── header.php              # Header template
│   └── footer.php              # Footer template
├── api/
│   ├── get-balance.php         # Get current coin balance
│   ├── claim-bonus.php         # Claim daily bonus
│   ├── reset-credits.php       # Reset credits
│   └── free-topup.php          # Free top-up endpoint
├── assets/
│   ├── css/
│   │   └── style.css           # Main stylesheet
│   ├── js/
│   │   └── main.js             # Main JavaScript
│   └── sounds/                 # Sound effects (optional)
├── public/
│   ├── index.php               # Homepage
│   ├── games.php               # Games listing page
│   ├── how-to-play.php         # How to play guide
│   ├── about.php               # About us page
│   ├── faq.php                 # FAQ page
│   ├── contact.php             # Contact page
│   ├── disclaimer.php          # Disclaimer page
│   ├── terms.php               # Terms & Conditions
│   ├── privacy-policy.php      # Privacy Policy
│   ├── responsible-gaming.php  # Responsible Gaming
│   └── games/
│       ├── roulette.php        # Roulette game
│       ├── slots.php           # Slots game
│       ├── rummy.php           # Rummy game
│       └── bingo.php           # Bingo game
├── logs/
│   └── contact_form.log        # Contact form submissions
└── README.md                   # This file
```

---

## 🚀 Getting Started

### Requirements

- **PHP 7.4+** (with MySQLi or PDO extension)
- **MySQL 5.7+** or compatible database
- **Web Server** (Apache with mod_rewrite or Nginx)
- **Modern Browser** (Chrome, Firefox, Safari, Edge)

### Installation Steps

#### 1. **Clone or Download the Project**

```bash
git clone <repository-url> imaginitiate-casino
cd imaginitiate-casino
```

#### 2. **Set Up the Database**

Create a new MySQL database:

```sql
CREATE DATABASE imaginitiate_casino;
USE imaginitiate_casino;

-- Create sessions table
CREATE TABLE sessions (
    id VARCHAR(32) PRIMARY KEY,
    user_ip VARCHAR(45),
    coins INT DEFAULT 1000,
    total_bet INT DEFAULT 0,
    total_won INT DEFAULT 0,
    games_played INT DEFAULT 0,
    games_won INT DEFAULT 0,
    last_bonus_claim DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create contact submissions table
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    subject VARCHAR(255),
    message TEXT,
    ip_address VARCHAR(45),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3. **Configure the Application**

Edit `config/config.php`:

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'imaginitiate_casino');

// Application Settings
define('APP_NAME', 'IMAGINITIATE');
define('APP_URL', 'https://imaginitiate.com');
define('INITIAL_COINS', 1000);
define('DAILY_BONUS', 200);
define('FREE_TOPUP', 500);
define('CREDIT_RESET', 500);
?>
```

#### 4. **Set File Permissions**

```bash
chmod 755 logs/
chmod 644 logs/contact_form.log
chmod 755 public/
chmod 755 includes/
chmod 755 api/
```

#### 5. **Deploy to Web Server**

- Upload all files to your web server's public directory
- Ensure the web server has read/write access to the `logs/` directory
- Configure your domain to point to the `public/` directory

#### 6. **Test the Installation**

Visit `https://yourdomai.com/imaginitiate-casino/public/` in your browser. You should see the homepage with 1000 coins.

---

## 🎮 Games Overview

### 1. **Roulette** 🎡
- Predict where the ball lands on the wheel
- Bet on specific numbers (36:1 odds) or colors/ranges (2:1 odds)
- Win up to 36x your bet
- **File:** `public/games/roulette.php`

### 2. **Slots** 🎰
- Spin the reels and match symbols
- Win 2x to 20x your bet based on symbols
- Classic casino experience
- **File:** `public/games/slots.php`

### 3. **Rummy** 🃏
- Arrange cards into sets and sequences
- First to arrange all cards wins
- Win 3x your bet
- **File:** `public/games/rummy.php`

### 4. **Bingo** 🎲
- Mark numbers as they're called
- Complete patterns to win
- Win 2x to 10x your bet
- **File:** `public/games/bingo.php`

---

## 💰 Coin System

### Initial Setup
- **Starting Coins:** 1000 (free)
- **Daily Bonus:** 200 coins (claim once per day)
- **Free Top-Up:** 500 coins (when balance < 100)
- **Credit Reset:** 500 coins (when balance = 0)

### Coin Flow
1. User starts with 1000 free coins
2. User places bets in games (coins deducted)
3. User wins or loses (coins added/deducted)
4. User can claim daily bonus
5. User can use free top-up when needed
6. User can reset credits when at zero

---

## 🔧 API Endpoints

### Get Balance
```
GET /api/get-balance.php
Response: { "balance": 1000, "status": "success" }
```

### Claim Daily Bonus
```
POST /api/claim-bonus.php
Response: { "bonus": 200, "new_balance": 1200, "status": "success" }
```

### Free Top-Up
```
POST /api/free-topup.php
Response: { "topup": 500, "new_balance": 600, "status": "success" }
```

### Reset Credits
```
POST /api/reset-credits.php
Response: { "reset": 500, "new_balance": 500, "status": "success" }
```

---

## 🎨 Customization

### Colors & Theme
Edit `assets/css/style.css` to customize:
- Primary colors (gold, purple)
- Background colors
- Text colors
- Animations and transitions

### Company Information
Update these files with your company details:
- `public/about.php` - Company information
- `public/contact.php` - Contact details
- `public/disclaimer.php` - Company name and address
- `public/terms.php` - Legal information
- `public/privacy-policy.php` - Privacy details

### Game Settings
Modify game parameters in each game file:
- Bet limits
- Payout multipliers
- Game difficulty
- Animation speeds

---

## 📱 Responsive Design

The platform is fully responsive and works on:
- **Desktop:** 1920x1080 and above
- **Tablet:** 768px to 1024px
- **Mobile:** 320px to 767px

All pages automatically adapt to screen size using CSS media queries.

---

## 🔒 Security Features

- **Session Management:** Secure session handling with cookies
- **Input Validation:** All user inputs are validated and sanitized
- **SQL Injection Prevention:** Prepared statements for database queries
- **XSS Protection:** Output escaping and input sanitization
- **HTTPS Ready:** Configure SSL/TLS on your server
- **No Real Money:** Virtual coins eliminate financial risk

---

## 📊 Analytics & Tracking

### Tracked Metrics
- Total games played
- Games won
- Total coins bet
- Total coins won
- Daily bonus claims
- Free top-ups used
- Contact form submissions

### Logging
- Contact form submissions: `logs/contact_form.log`
- Game statistics: Stored in database
- Session data: Stored in browser cookies

---

## 🚀 Deployment Checklist

- [ ] Database created and configured
- [ ] `config/config.php` updated with correct credentials
- [ ] All files uploaded to server
- [ ] File permissions set correctly
- [ ] SSL/TLS certificate installed
- [ ] Domain configured
- [ ] Homepage loads correctly
- [ ] Games are playable
- [ ] Contact form works
- [ ] All pages load without errors
- [ ] Mobile responsiveness verified
- [ ] Sound effects working (optional)
- [ ] Analytics tracking working
- [ ] Backups configured

---

## 🐛 Troubleshooting

### Games Not Loading
- Check PHP error logs
- Verify database connection
- Clear browser cache
- Check file permissions

### Session Not Persisting
- Verify cookies are enabled
- Check cookie settings in `config.php`
- Ensure browser allows third-party cookies

### Database Connection Error
- Verify database credentials in `config/config.php`
- Check database server is running
- Verify user has correct permissions
- Check firewall settings

### Contact Form Not Working
- Verify `logs/` directory exists and is writable
- Check PHP mail configuration
- Verify form validation is passing
- Check browser console for JavaScript errors

---

## 📞 Support

For issues or questions:
- **Email:** contact@imaginitiate.com
- **Address:** A-96 GROUND FLOOR, SHANKAR GARDEN VIKASPURI, NEW DELHI, East Delhi, Delhi, 110018

---

## 📄 Legal

- **Terms & Conditions:** `public/terms.php`
- **Privacy Policy:** `public/privacy-policy.php`
- **Disclaimer:** `public/disclaimer.php`
- **Responsible Gaming:** `public/responsible-gaming.php`

---

## 📈 Future Enhancements

Potential features for future versions:
- More games (Blackjack, Poker, Keno)
- Leaderboards and achievements
- Social features (friend lists, challenges)
- Mobile app version
- Advanced analytics dashboard
- Multi-language support
- VIP membership tiers
- Special events and tournaments

---

## 📝 Version History

- **v1.0.0** (January 2024) - Initial release
  - 4 core games (Roulette, Slots, Rummy, Bingo)
  - Virtual coin system
  - Responsive design
  - Complete compliance pages

---

## 🙏 Acknowledgments

Built with:
- **PHP 7.4+**
- **MySQL 5.7+**
- **HTML5**
- **CSS3**
- **JavaScript (Vanilla)**

---

## 📜 License

IMAGINITIATE is proprietary software. All rights reserved.

---

**Last Updated:** January 2024  
**Version:** 1.0.0  
**Status:** Production Ready

---

## 🎮 Ready to Play?

Visit the homepage and start playing with 1000 free coins!

```
https://yourdomai.com/imaginitiate-casino/public/
```

Enjoy your gaming experience! 🎉
