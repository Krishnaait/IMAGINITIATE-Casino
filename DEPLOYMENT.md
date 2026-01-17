# IMAGINITIATE - Deployment Guide

## 🚀 Railway Deployment

### Current Issue
If you're seeing a 404 error, it's because Railway needs to be configured to serve from the `public/` directory.

### Solution Steps

#### Step 1: Update Railway Configuration

The following files have been added to configure Railway properly:
- `railway.toml` - Railway configuration
- `nixpacks.toml` - Nixpacks build configuration
- `Procfile` - Process configuration
- `public/.htaccess` - Apache configuration

#### Step 2: Configure Database on Railway

1. Go to your Railway dashboard
2. Click on your project
3. Click "New" → "Database" → "Add MySQL"
4. Copy the database credentials
5. Update `config/config.php` with Railway database credentials:

```php
define('DB_HOST', 'your-railway-db-host');
define('DB_USER', 'your-railway-db-user');
define('DB_PASS', 'your-railway-db-password');
define('DB_NAME', 'railway');
define('DB_PORT', 3306);
```

#### Step 3: Set Environment Variables

In Railway dashboard:
1. Go to your service
2. Click "Variables" tab
3. Add these variables:

```
PORT=8080
APP_ENV=production
APP_URL=https://your-app.up.railway.app
```

#### Step 4: Create Database Tables

Connect to Railway MySQL and run:

```sql
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

#### Step 5: Redeploy

After pushing the new configuration files:
1. Railway will automatically redeploy
2. Wait for deployment to complete
3. Visit your URL: `https://your-app.up.railway.app/`

---

## 🌐 Alternative: Deploy to Other Platforms

### Heroku

1. Install Heroku CLI
2. Login: `heroku login`
3. Create app: `heroku create imaginitiate-casino`
4. Add MySQL: `heroku addons:create cleardb:ignite`
5. Push: `git push heroku master`

### Vercel (Static + Serverless)

1. Install Vercel CLI: `npm i -g vercel`
2. Run: `vercel`
3. Follow prompts
4. Configure serverless functions for PHP

### Traditional Hosting (cPanel/Shared)

1. Upload files via FTP
2. Extract to `public_html/`
3. Create MySQL database
4. Update `config/config.php`
5. Import database schema
6. Visit your domain

---

## 🔧 Troubleshooting

### 404 Error
**Problem:** Page not found  
**Solution:** Ensure web server points to `public/` directory

### Database Connection Error
**Problem:** Can't connect to database  
**Solution:** Verify database credentials in `config/config.php`

### Blank Page
**Problem:** White screen  
**Solution:** Check PHP error logs, enable error reporting

### CSS Not Loading
**Problem:** Page loads but no styling  
**Solution:** Check asset paths, ensure they're relative

---

## 📞 Support

For deployment issues:
- Email: contact@imaginitiate.com
- GitHub: https://github.com/Krishnaait/IMAGINITIATE-Casino/issues

---

## 🎯 Quick Fix for Railway

If you're seeing 404 on Railway right now:

1. **Push the new config files:**
   ```bash
   git add railway.toml nixpacks.toml Procfile public/.htaccess DEPLOYMENT.md
   git commit -m "Add Railway deployment configuration"
   git push origin master
   ```

2. **Railway will auto-redeploy** with the correct configuration

3. **Wait 2-3 minutes** for deployment to complete

4. **Visit your URL** - it should now work!

---

**Last Updated:** January 2024
