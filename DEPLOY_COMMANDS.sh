#!/bin/bash

echo "═══════════════════════════════════════════════════════════"
echo "  Laravel 11 SaaS Platform - Deployment Commands Reference"
echo "═══════════════════════════════════════════════════════════"
echo ""

# Archive the project for upload
archive_project() {
    echo "📦 Creating deployment archive..."
    cd /root/repo
    tar -czf master-saas-deploy.tar.gz master-saas/
    echo "✅ Created: master-saas-deploy.tar.gz"
    echo "📏 Size: $(du -h master-saas-deploy.tar.gz | cut -f1)"
}

# Upload to server
upload_to_server() {
    echo "📤 Upload commands:"
    echo ""
    echo "scp -P 65002 master-saas-deploy.tar.gz u458200173@srv605.hstgr.io:/home/u458200173/domains/astracareportal.com/public_html/"
    echo ""
}

# Server setup commands
server_commands() {
    echo "🖥️  Commands to run on server:"
    echo ""
    cat << 'SERVEREOF'
# SSH into server
ssh -p 65002 u458200173@srv605.hstgr.io

# Navigate and extract
cd /home/u458200173/domains/astracareportal.com/public_html/
tar -xzf master-saas-deploy.tar.gz
mv master-saas master.astracareportal.com
cd master.astracareportal.com

# Install dependencies (production mode)
composer install --no-dev --optimize-autoload

# Configure environment
cp .env.production.example .env
nano .env  # Edit with your credentials

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache

# Test
php artisan optimize
SERVEREOF
}

# Show help
show_help() {
    echo ""
    echo "Available commands:"
    echo "  ./DEPLOY_COMMANDS.sh archive    - Create deployment archive"
    echo "  ./DEPLOY_COMMANDS.sh upload     - Show upload commands"
    echo "  ./DEPLOY_COMMANDS.sh server     - Show server setup commands"
    echo "  ./DEPLOY_COMMANDS.sh help       - Show this help"
    echo ""
}

# Main
case "$1" in
    archive)
        archive_project
        ;;
    upload)
        upload_to_server
        ;;
    server)
        server_commands
        ;;
    help|"")
        show_help
        ;;
    *)
        echo "❌ Unknown command: $1"
        show_help
        exit 1
        ;;
esac
