# IMAGINITIATE - Quick Start Guide

## ⚡ 5-Minute Setup

### Step 1: Extract Files
```bash
tar -xzf imaginitiate-casino-complete.tar.gz
cd imaginitiate-casino
```

### Step 2: Create Database
```bash
mysql -u root -p < database.sql
```

Or manually:
```sql
CREATE DATABASE imaginitiate_casino;
USE imaginitiate_casino;

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

### Step 3: Configure
Edit `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'imaginitiate_casino');
```

### Step 4: Set Permissions
```bash
chmod 755 logs
chmod 644 config/config.php
chmod 755 public
```

### Step 5: Run Locally
```bash
cd public
php -S localhost:8000
```

Visit: `http://localhost:8000/`

---

## 🚀 Deploy to Production

### Using FTP
1. Upload all files to `public_html/imaginitiate-casino/`
2. Update `config/config.php` with production database
3. Set permissions: `chmod 755 logs`
4. Visit your domain

### Using SSH
```bash
ssh user@server.com
git clone https://github.com/imaginitiate/casino.git ~/public_html/imaginitiate-casino
cd ~/public_html/imaginitiate-casino
# Update config/config.php
chmod 755 logs
```

### Using cPanel
1. Upload ZIP file
2. Extract in public_html
3. Update config/config.php
4. Set permissions
5. Visit domain

---

## 📋 Checklist

- [ ] Files extracted
- [ ] Database created
- [ ] config/config.php updated
- [ ] Permissions set
- [ ] Homepage loads
- [ ] Games playable
- [ ] Contact form works
- [ ] Daily bonus works
- [ ] Free top-up works

---

## 🎮 Test the Games

1. **Homepage:** Should show 1000 coins
2. **Roulette:** Click "Spin Wheel"
3. **Slots:** Click "Spin"
4. **Rummy:** Click "Deal Cards"
5. **Bingo:** Click "Call Number"

---

## 📞 Support

- **Email:** contact@imaginitiate.com
- **Docs:** See README.md
- **Issues:** Check INSTALLATION.md

---

## 🎉 You're Ready!

Your IMAGINITIATE casino is now live!

Enjoy! 🎮
