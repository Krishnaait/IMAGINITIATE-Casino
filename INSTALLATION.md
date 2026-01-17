# IMAGINITIATE - Installation & Deployment Guide

## 📋 Table of Contents

1. [System Requirements](#system-requirements)
2. [Local Installation](#local-installation)
3. [Server Deployment](#server-deployment)
4. [Database Setup](#database-setup)
5. [Configuration](#configuration)
6. [Testing](#testing)
7. [Troubleshooting](#troubleshooting)
8. [Maintenance](#maintenance)

---

## System Requirements

### Minimum Requirements

| Component | Version | Notes |
|-----------|---------|-------|
| PHP | 7.4+ | With MySQLi or PDO extension |
| MySQL | 5.7+ | Or MariaDB 10.2+ |
| Web Server | Apache 2.4+ or Nginx 1.14+ | With mod_rewrite (Apache) |
| Disk Space | 50MB+ | For application files and logs |
| RAM | 512MB+ | For server operation |
| Bandwidth | Unlimited | For production use |

### Recommended Requirements

| Component | Version | Notes |
|-----------|---------|-------|
| PHP | 8.0+ | Latest stable version |
| MySQL | 8.0+ | Latest stable version |
| Web Server | Apache 2.4.50+ or Nginx 1.20+ | Latest stable |
| Disk Space | 500MB+ | For growth and backups |
| RAM | 2GB+ | For optimal performance |
| SSL/TLS | Let's Encrypt | Free HTTPS certificate |

### Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS Safari, Chrome Mobile)

---

## Local Installation

### Step 1: Download the Project

```bash
# Clone from repository
git clone https://github.com/imaginitiate/casino.git imaginitiate-casino
cd imaginitiate-casino

# Or download and extract ZIP
unzip imaginitiate-casino.zip
cd imaginitiate-casino
```

### Step 2: Install PHP Dependencies

```bash
# If using Composer (optional)
composer install

# Or ensure PHP extensions are installed
php -m | grep -i mysqli
php -m | grep -i pdo
```

### Step 3: Create Local Database

**Using MySQL CLI:**

```bash
mysql -u root -p
```

```sql
CREATE DATABASE imaginitiate_casino_local;
USE imaginitiate_casino_local;

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

-- Create game statistics table
CREATE TABLE game_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(32),
    game_name VARCHAR(50),
    bet_amount INT,
    win_amount INT,
    result VARCHAR(10),
    played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES sessions(id)
);

EXIT;
```

### Step 4: Configure Application

Edit `config/config.php`:

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Your MySQL password
define('DB_NAME', 'imaginitiate_casino_local');
define('DB_PORT', 3306);

// Application Settings
define('APP_NAME', 'IMAGINITIATE');
define('APP_URL', 'http://localhost:8000');
define('APP_ENV', 'development'); // or 'production'

// Coin Settings
define('INITIAL_COINS', 1000);
define('DAILY_BONUS', 200);
define('FREE_TOPUP', 500);
define('CREDIT_RESET', 500);

// Session Settings
define('SESSION_TIMEOUT', 86400 * 30); // 30 days
define('SESSION_COOKIE_NAME', 'imaginitiate_session');
define('SESSION_COOKIE_SECURE', false); // true for HTTPS
define('SESSION_COOKIE_HTTPONLY', true);

// Security
define('ENABLE_DEBUG', true); // false in production
?>
```

### Step 5: Set File Permissions

```bash
# Create logs directory
mkdir -p logs

# Set permissions
chmod 755 logs
chmod 644 config/config.php
chmod 755 public
chmod 755 includes
chmod 755 api

# Make logs writable
chmod 666 logs/contact_form.log 2>/dev/null || touch logs/contact_form.log && chmod 666 logs/contact_form.log
```

### Step 6: Start Local Server

**Using PHP Built-in Server:**

```bash
cd public
php -S localhost:8000
```

Then visit: `http://localhost:8000/`

**Using Apache:**

```bash
# Create virtual host
sudo nano /etc/apache2/sites-available/imaginitiate.local.conf
```

```apache
<VirtualHost *:80>
    ServerName imaginitiate.local
    ServerAlias www.imaginitiate.local
    DocumentRoot /path/to/imaginitiate-casino/public

    <Directory /path/to/imaginitiate-casino/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/imaginitiate-error.log
    CustomLog ${APACHE_LOG_DIR}/imaginitiate-access.log combined
</VirtualHost>
```

```bash
# Enable site
sudo a2ensite imaginitiate.local.conf
sudo a2enmod rewrite
sudo systemctl restart apache2

# Add to /etc/hosts
echo "127.0.0.1 imaginitiate.local" | sudo tee -a /etc/hosts
```

Then visit: `http://imaginitiate.local/`

---

## Server Deployment

### Step 1: Choose Hosting Provider

Recommended providers:
- **Shared Hosting:** Bluehost, SiteGround, HostGator
- **VPS:** DigitalOcean, Linode, AWS Lightsail
- **Cloud:** AWS, Google Cloud, Azure

### Step 2: Upload Files

**Using FTP/SFTP:**

```bash
# Using FileZilla or WinSCP
# Connect to server
# Upload all files to public_html or www directory
```

**Using SSH:**

```bash
# Connect to server
ssh user@your-server.com

# Clone repository
git clone https://github.com/imaginitiate/casino.git ~/public_html/imaginitiate-casino
cd ~/public_html/imaginitiate-casino
```

### Step 3: Configure Server

```bash
# Set permissions
chmod 755 logs
chmod 644 config/config.php
chmod 755 public
chmod -R 755 includes
chmod -R 755 api

# Create logs file
touch logs/contact_form.log
chmod 666 logs/contact_form.log
```

### Step 4: Set Up SSL/TLS

**Using Let's Encrypt (Free):**

```bash
# Install Certbot
sudo apt-get install certbot python3-certbot-apache

# Get certificate
sudo certbot certonly --apache -d imaginitiate.com -d www.imaginitiate.com

# Auto-renew
sudo systemctl enable certbot.timer
sudo systemctl start certbot.timer
```

### Step 5: Configure Web Server

**Apache Configuration:**

```bash
sudo nano /etc/apache2/sites-available/imaginitiate.conf
```

```apache
<VirtualHost *:80>
    ServerName imaginitiate.com
    ServerAlias www.imaginitiate.com
    DocumentRoot /var/www/html/imaginitiate-casino/public
    
    Redirect permanent / https://imaginitiate.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName imaginitiate.com
    ServerAlias www.imaginitiate.com
    DocumentRoot /var/www/html/imaginitiate-casino/public

    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/imaginitiate.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/imaginitiate.com/privkey.pem

    <Directory /var/www/html/imaginitiate-casino/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/imaginitiate-error.log
    CustomLog ${APACHE_LOG_DIR}/imaginitiate-access.log combined
</VirtualHost>
```

```bash
# Enable site and modules
sudo a2ensite imaginitiate.conf
sudo a2enmod rewrite
sudo a2enmod ssl
sudo systemctl restart apache2
```

**Nginx Configuration:**

```bash
sudo nano /etc/nginx/sites-available/imaginitiate
```

```nginx
server {
    listen 80;
    server_name imaginitiate.com www.imaginitiate.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name imaginitiate.com www.imaginitiate.com;

    ssl_certificate /etc/letsencrypt/live/imaginitiate.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/imaginitiate.com/privkey.pem;

    root /var/www/html/imaginitiate-casino/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    access_log /var/log/nginx/imaginitiate-access.log;
    error_log /var/log/nginx/imaginitiate-error.log;
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/imaginitiate /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

---

## Database Setup

### Create Database

```sql
CREATE DATABASE imaginitiate_casino CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE imaginitiate_casino;

-- Sessions table
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
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_ip (user_ip),
    INDEX idx_created_at (created_at)
);

-- Contact submissions
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_submitted_at (submitted_at)
);

-- Game statistics
CREATE TABLE game_stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(32),
    game_name VARCHAR(50),
    bet_amount INT,
    win_amount INT,
    result VARCHAR(10),
    played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES sessions(id),
    INDEX idx_session_id (session_id),
    INDEX idx_game_name (game_name),
    INDEX idx_played_at (played_at)
);

-- Create database user
CREATE USER 'imaginitiate'@'localhost' IDENTIFIED BY 'secure_password_here';
GRANT ALL PRIVILEGES ON imaginitiate_casino.* TO 'imaginitiate'@'localhost';
FLUSH PRIVILEGES;
```

### Backup Database

```bash
# Backup
mysqldump -u imaginitiate -p imaginitiate_casino > backup_$(date +%Y%m%d_%H%M%S).sql

# Restore
mysql -u imaginitiate -p imaginitiate_casino < backup_20240101_120000.sql
```

---

## Configuration

### Production Configuration

Edit `config/config.php` for production:

```php
<?php
// Database Configuration
define('DB_HOST', 'db.server.com');
define('DB_USER', 'imaginitiate');
define('DB_PASS', 'your_secure_password');
define('DB_NAME', 'imaginitiate_casino');

// Application Settings
define('APP_ENV', 'production');
define('APP_URL', 'https://imaginitiate.com');
define('ENABLE_DEBUG', false);

// Security
define('SESSION_COOKIE_SECURE', true); // HTTPS only
define('SESSION_COOKIE_HTTPONLY', true);
define('SESSION_COOKIE_SAMESITE', 'Strict');

// Email Configuration (optional)
define('MAIL_FROM', 'noreply@imaginitiate.com');
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your_email@gmail.com');
define('MAIL_PASSWORD', 'your_app_password');
?>
```

### Environment Variables

Create `.env` file:

```env
DB_HOST=localhost
DB_USER=imaginitiate
DB_PASS=secure_password
DB_NAME=imaginitiate_casino

APP_ENV=production
APP_URL=https://imaginitiate.com
APP_DEBUG=false

MAIL_FROM=noreply@imaginitiate.com
```

---

## Testing

### Functionality Testing

```bash
# Test homepage
curl -I https://imaginitiate.com/

# Test games
curl -I https://imaginitiate.com/games.php

# Test API
curl https://imaginitiate.com/api/get-balance.php

# Test contact form
curl -X POST -d "name=Test&email=test@test.com&subject=Test&message=Test" \
  https://imaginitiate.com/public/contact.php
```

### Performance Testing

```bash
# Using Apache Bench
ab -n 1000 -c 10 https://imaginitiate.com/

# Using wrk
wrk -t12 -c400 -d30s https://imaginitiate.com/
```

### Security Testing

```bash
# SSL/TLS check
openssl s_client -connect imaginitiate.com:443

# Security headers
curl -I https://imaginitiate.com/ | grep -i "security\|x-frame\|x-content"
```

---

## Troubleshooting

### Database Connection Error

```
Error: SQLSTATE[HY000]: General error: 2006 MySQL server has gone away
```

**Solution:**
- Check MySQL is running: `sudo systemctl status mysql`
- Verify credentials in `config/config.php`
- Check firewall allows MySQL port 3306
- Increase max_allowed_packet in MySQL

### Session Not Persisting

```
Session data lost after page refresh
```

**Solution:**
- Enable cookies in browser
- Check cookie settings in `config/config.php`
- Verify browser allows cookies for the domain
- Check session timeout settings

### 404 Errors

```
404 Not Found - The requested resource could not be found
```

**Solution:**
- Verify mod_rewrite is enabled: `a2enmod rewrite`
- Check `.htaccess` file exists in public directory
- Verify DocumentRoot points to public directory
- Check file permissions

### High CPU/Memory Usage

```
Server running slowly or timing out
```

**Solution:**
- Optimize database queries
- Enable caching (Redis, Memcached)
- Increase PHP memory_limit
- Use CDN for static assets
- Implement rate limiting

---

## Maintenance

### Regular Backups

```bash
# Daily backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u imaginitiate -p imaginitiate_casino > /backups/db_$DATE.sql
tar -czf /backups/files_$DATE.tar.gz /var/www/html/imaginitiate-casino
```

### Monitor Logs

```bash
# Check PHP errors
tail -f /var/log/php-fpm.log

# Check web server errors
tail -f /var/log/apache2/error.log
# or
tail -f /var/log/nginx/error.log

# Check application logs
tail -f logs/contact_form.log
```

### Update PHP

```bash
# Check current version
php -v

# Update PHP
sudo apt-get update
sudo apt-get upgrade php

# Restart web server
sudo systemctl restart apache2
# or
sudo systemctl restart nginx
```

### Monitor Performance

```bash
# Check server load
uptime

# Check disk space
df -h

# Check memory usage
free -h

# Check MySQL
mysqladmin -u imaginitiate -p status
```

---

## Support

For deployment issues:
- Email: contact@imaginitiate.com
- Documentation: See README.md
- Logs: Check application and server logs

---

**Last Updated:** January 2024  
**Version:** 1.0.0
