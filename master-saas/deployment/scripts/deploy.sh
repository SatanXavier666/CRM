#!/bin/bash

# Laravel SaaS Deployment Script for master.astracareportal.com
# This script automates the deployment process

set -e  # Exit on any error

echo "🚀 Starting deployment for master.astracareportal.com..."

# Variables
APP_DIR="/home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com"
BRANCH="main"

# Navigate to application directory
cd $APP_DIR

# Enable maintenance mode
echo "🔧 Enabling maintenance mode..."
php artisan down || true

# Pull latest code from repository
echo "📥 Pulling latest code from repository..."
git fetch origin $BRANCH
git reset --hard origin/$BRANCH

# Install/Update Composer dependencies (optimized for production)
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install/Update NPM dependencies
echo "📦 Installing NPM dependencies..."
npm ci --production

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Clear and optimize Laravel caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize Laravel
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run database migrations (with backup)
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Restart queue workers
echo "♻️  Restarting queue workers..."
php artisan queue:restart

# Fix permissions
echo "🔐 Setting correct permissions..."
chmod -R 755 storage bootstrap/cache
chown -R u458200173:u458200173 storage bootstrap/cache

# Disable maintenance mode
echo "✅ Disabling maintenance mode..."
php artisan up

# Clear OPcache (if available)
if command -v php-fpm &> /dev/null; then
    echo "🔄 Reloading PHP-FPM..."
    sudo systemctl reload php8.3-fpm
fi

echo "✨ Deployment completed successfully!"
echo "🌐 Site: https://master.astracareportal.com"
