#!/bin/bash

# Deployment script for AstraCare Portal to Hostinger
# Server: u458200173@srv602.hstgr.io
# Domain: master.astracareportal.com

SERVER="u458200173@srv602.hstgr.io"
REMOTE_PATH="/home/u458200173/domains/master.astracareportal.com/private_html"
LOCAL_PATH="/root/repo/master-saas"

echo "🚀 Starting deployment to master.astracareportal.com..."

# Deploy .env file with MySQL configuration
echo "📦 Deploying .env configuration..."
sshpass -p 'T3rr@g0n@2025' scp $LOCAL_PATH/.env $SERVER:$REMOTE_PATH/.env

# Deploy compiled assets
echo "🎨 Deploying compiled frontend assets..."
sshpass -p 'T3rr@g0n@2025' scp -r $LOCAL_PATH/public/build $SERVER:$REMOTE_PATH/public/

# Deploy Vue pages
echo "📄 Deploying Vue components..."
sshpass -p 'T3rr@g0n@2025' scp -r $LOCAL_PATH/resources/js/Pages $SERVER:$REMOTE_PATH/resources/js/

# Run migrations and seeders on production
echo "🗄️ Running database migrations..."
sshpass -p 'T3rr@g0n@2025' ssh $SERVER "cd $REMOTE_PATH && php artisan migrate --force"

echo "🌱 Running database seeders..."
sshpass -p 'T3rr@g0n@2025' ssh $SERVER "cd $REMOTE_PATH && php artisan db:seed --force"

# Clear and optimize caches
echo "🧹 Clearing and optimizing caches..."
sshpass -p 'T3rr@g0n@2025' ssh $SERVER "cd $REMOTE_PATH && php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear"

echo "⚡ Optimizing for production..."
sshpass -p 'T3rr@g0n@2025' ssh $SERVER "cd $REMOTE_PATH && php artisan config:cache && php artisan route:cache && php artisan view:cache"

echo "✅ Deployment complete!"
echo "🌐 Visit: https://master.astracareportal.com"
