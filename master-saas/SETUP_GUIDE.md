# Complete Setup Guide - AstraCare Portal SaaS

## 📋 Overview

This guide will walk you through deploying the Laravel 11 multi-tenant SaaS platform to `master.astracareportal.com`.

## 🎯 Prerequisites Checklist

Before starting, ensure you have:

- [ ] SSH access to Hostinger server (srv605.hstgr.io:65002)
- [ ] Domain `master.astracareportal.com` pointed to server IP
- [ ] MySQL database created on Hostinger
- [ ] Database credentials (username, password, database name)
- [ ] Stripe account for billing (optional, but recommended)
- [ ] AWS S3 or DigitalOcean Spaces for file storage (optional)

## 🚀 Step-by-Step Deployment

### Step 1: Prepare Server Environment

```bash
# SSH into your server
ssh -p 65002 u458200173@srv605.hstgr.io

# Navigate to the target directory
cd /home/u458200173/domains/astracareportal.com/public_html/

# Create directory for master subdomain
mkdir master.astracareportal.com
cd master.astracareportal.com
```

### Step 2: Clone and Upload Files

**Option A: Using Git (Recommended)**

```bash
# Initialize git repository
git init
git remote add origin <your-github-repo-url>
git pull origin main
```

**Option B: Using SCP from local machine**

```bash
# From your local machine
scp -P 65002 -r /path/to/master-saas/* u458200173@srv605.hstgr.io:/home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com/
```

**Option C: Using FTP/SFTP**

Use FileZilla or similar FTP client:
- Host: srv605.hstgr.io
- Port: 65002
- Upload all files to: `/home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com/`

### Step 3: Install Dependencies

```bash
cd /home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com

# Install Composer dependencies (production mode)
composer install --no-dev --optimize-autoload

# Install Node dependencies
npm ci

# Build frontend assets
npm run build
```

### Step 4: Configure Environment

```bash
# Copy production environment file
cp .env.production.example .env

# Edit environment file
nano .env
```

**Update these critical values in `.env`:**

```env
APP_NAME="AstraCare Portal"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://master.astracareportal.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u458200173_master_saas
DB_USERNAME=u458200173_master_user
DB_PASSWORD=your_database_password

# Redis Configuration (if available)
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@astracareportal.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@astracareportal.com

# Stripe Configuration (add later)
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...

# Session and Cache
SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

```bash
# Generate application key
php artisan key:generate

# Set proper permissions
chmod -R 755 storage bootstrap/cache
```

### Step 5: Database Setup

```bash
# Run migrations
php artisan migrate --force

# Seed database (if you have seeders)
php artisan db:seed --force

# Run tenancy migrations
php artisan tenants:migrate --force
```

### Step 6: Optimize Laravel

```bash
# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Step 7: Configure Nginx

**Check if Hostinger uses cPanel or direct Nginx:**

If Hostinger uses cPanel, create a `.htaccess` file in the `public` directory:

```bash
nano public/.htaccess
```

Add this content:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

**If you have direct Nginx access:**

```bash
# Copy Nginx configuration
sudo cp deployment/nginx/master.astracareportal.com.conf /etc/nginx/sites-available/
sudo ln -s /etc/nginx/sites-available/master.astracareportal.com.conf /etc/nginx/sites-enabled/

# Test and reload
sudo nginx -t
sudo systemctl reload nginx
```

### Step 8: SSL Certificate

**Using cPanel (Hostinger's AutoSSL):**

1. Log into cPanel
2. Go to "SSL/TLS Status"
3. Select `master.astracareportal.com`
4. Click "Run AutoSSL"

**Using Let's Encrypt (if you have shell access):**

```bash
sudo certbot --nginx -d master.astracareportal.com
```

### Step 9: Set Up Queue Workers (Optional but Recommended)

**Using Supervisor:**

```bash
# Copy supervisor config
sudo cp deployment/supervisor/laravel-worker.conf /etc/supervisor/conf.d/

# Update and start
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start master-saas-worker:*
```

**Using Cron (Alternative):**

Add to crontab:

```bash
crontab -e
```

Add this line:

```bash
* * * * * cd /home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com && php artisan schedule:run >> /dev/null 2>&1
```

### Step 10: Test the Installation

1. Visit `https://master.astracareportal.com`
2. You should see the welcome page
3. Check error logs if issues occur:

```bash
tail -f storage/logs/laravel.log
```

## 🔧 Post-Deployment Configuration

### Creating Super Admin User

```bash
php artisan tinker

# Inside tinker
use App\Models\User;
$user = User::create([
    'name' => 'Admin',
    'email' => 'admin@astracareportal.com',
    'password' => bcrypt('secure-password-here')
]);

# Assign super admin role (after setting up roles)
$user->assignRole('super-admin');
```

### Setting Up Roles and Permissions

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

### Creating First Tenant

```bash
php artisan tinker

# Inside tinker
use Stancl\Tenancy\Database\Models\Domain;

$tenant = \App\Models\Tenant::create(['id' => 'acme']);
$tenant->domains()->create(['domain' => 'acme.master.astracareportal.com']);
```

## 🔄 Continuous Deployment with GitHub Actions

### Step 1: Set Up Repository Secrets

In your GitHub repository:
1. Go to Settings → Secrets and variables → Actions
2. Add these secrets:

- `SSH_HOST`: srv605.hstgr.io
- `SSH_USERNAME`: u458200173
- `SSH_PASSWORD`: your_ssh_password
- `SSH_PORT`: 65002

### Step 2: Enable GitHub Actions

The workflow file is already created at `.github/workflows/deploy.yml`

Every push to `main` branch will trigger automatic deployment.

## 🧪 Testing Your Deployment

### 1. Test Homepage

```bash
curl -I https://master.astracareportal.com
# Should return HTTP 200
```

### 2. Test Database Connection

```bash
php artisan tinker
DB::connection()->getPdo();
# Should return PDO object
```

### 3. Test Redis Connection

```bash
php artisan tinker
Cache::put('test', 'value', 60);
Cache::get('test');
# Should return 'value'
```

### 4. Test Queue Processing

```bash
php artisan queue:work redis --once
```

## 📊 Monitoring & Maintenance

### Log Files

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Nginx logs (if accessible)
tail -f /var/log/nginx/master.astracareportal.com-access.log
tail -f /var/log/nginx/master.astracareportal.com-error.log
```

### Database Backups

Set up automated backups:

```bash
# Add to crontab
0 2 * * * mysqldump -u DB_USER -pDB_PASS DB_NAME | gzip > /backups/master-saas-$(date +\%Y\%m\%d).sql.gz
```

### Cache Clearing (if site behaves oddly)

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🚨 Troubleshooting

### Issue: "500 Internal Server Error"

```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Ensure permissions are correct
chmod -R 755 storage bootstrap/cache

# Clear all caches
php artisan optimize:clear
```

### Issue: "CSRF token mismatch"

```bash
# Clear config cache
php artisan config:clear

# Ensure SESSION_DRIVER is set correctly in .env
```

### Issue: "Class not found"

```bash
# Regenerate autoload
composer dump-autoload

# Clear config cache
php artisan config:clear
```

### Issue: Assets not loading (CSS/JS)

```bash
# Rebuild assets
npm run build

# Clear view cache
php artisan view:clear

# Check asset paths in browser developer tools
```

### Issue: Database connection failed

1. Verify database credentials in `.env`
2. Ensure database exists in cPanel
3. Test connection:

```bash
mysql -u USERNAME -p DATABASE_NAME
```

## 📞 Support

If you encounter issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs
3. Enable debug mode temporarily: Set `APP_DEBUG=true` in `.env`
4. Remember to set `APP_DEBUG=false` after fixing!

## ✅ Deployment Checklist

- [ ] Files uploaded to server
- [ ] Dependencies installed (composer, npm)
- [ ] `.env` configured with correct values
- [ ] Database created and migrated
- [ ] SSL certificate installed
- [ ] Application key generated
- [ ] Caches optimized
- [ ] Queue workers running
- [ ] Cron jobs configured
- [ ] Backups scheduled
- [ ] Super admin created
- [ ] Site accessible via HTTPS
- [ ] GitHub Actions configured

---

**Congratulations! Your Laravel SaaS platform is now live! 🎉**
