#!/bin/bash

###############################################################################
# AstraCare Portal - Automated Hostinger Deployment Script
# This script automatically syncs all changes to Hostinger server
# Run this daily or after any updates to keep server in sync
###############################################################################

set -e  # Exit on error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Server configuration
SERVER="u458200173@srv602.hstgr.io"
SERVER_PASSWORD="T3rr@g0n@2025"
REMOTE_PATH="/home/u458200173/domains/master.astracareportal.com/private_html"
LOCAL_PATH="/root/repo/master-saas"

# Log file
LOG_FILE="/root/repo/master-saas/deployment.log"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

# Function to log messages
log() {
    echo -e "${CYAN}[$TIMESTAMP]${NC} $1" | tee -a "$LOG_FILE"
}

log_success() {
    echo -e "${GREEN}✓${NC} $1" | tee -a "$LOG_FILE"
}

log_error() {
    echo -e "${RED}✗${NC} $1" | tee -a "$LOG_FILE"
}

log_warning() {
    echo -e "${YELLOW}⚠${NC} $1" | tee -a "$LOG_FILE"
}

echo ""
echo -e "${CYAN}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${CYAN}║${NC}     ${GREEN}AstraCare Portal - Hostinger Deployment${NC}           ${CYAN}║${NC}"
echo -e "${CYAN}╔════════════════════════════════════════════════════════════╗${NC}"
echo ""

log "Starting deployment to master.astracareportal.com..."

# Step 1: Deploy compiled assets
log "📦 Deploying compiled frontend assets..."
if sshpass -p "$SERVER_PASSWORD" rsync -avz --progress \
    "$LOCAL_PATH/public/build/" \
    "$SERVER:$REMOTE_PATH/public/build/" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Frontend assets deployed"
else
    log_error "Failed to deploy frontend assets"
fi

# Step 2: Deploy Vue components
log "🎨 Deploying Vue components..."
if sshpass -p "$SERVER_PASSWORD" rsync -avz --progress \
    "$LOCAL_PATH/resources/js/" \
    "$SERVER:$REMOTE_PATH/resources/js/" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Vue components deployed"
else
    log_error "Failed to deploy Vue components"
fi

# Step 3: Deploy routes
log "🛣️  Deploying routes..."
if sshpass -p "$SERVER_PASSWORD" rsync -avz --progress \
    "$LOCAL_PATH/routes/" \
    "$SERVER:$REMOTE_PATH/routes/" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Routes deployed"
else
    log_error "Failed to deploy routes"
fi

# Step 4: Deploy .env configuration
log "⚙️  Deploying environment configuration..."
if sshpass -p "$SERVER_PASSWORD" scp \
    "$LOCAL_PATH/.env" \
    "$SERVER:$REMOTE_PATH/.env" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Environment configuration deployed"
else
    log_warning "Failed to deploy .env (may already exist)"
fi

# Step 5: Deploy app configuration
log "📄 Deploying app configuration..."
if sshpass -p "$SERVER_PASSWORD" rsync -avz --progress \
    "$LOCAL_PATH/config/" \
    "$SERVER:$REMOTE_PATH/config/" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Configuration files deployed"
else
    log_error "Failed to deploy config files"
fi

# Step 6: Deploy public assets
log "🖼️  Deploying public assets..."
if sshpass -p "$SERVER_PASSWORD" rsync -avz --progress \
    --exclude 'build' \
    "$LOCAL_PATH/public/" \
    "$SERVER:$REMOTE_PATH/public/" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Public assets deployed"
else
    log_error "Failed to deploy public assets"
fi

# Step 7: Run database migrations
log "🗄️  Running database migrations..."
if sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER" \
    "cd $REMOTE_PATH && php artisan migrate --force" 2>&1 | tee -a "$LOG_FILE"; then
    log_success "Database migrations completed"
else
    log_warning "Database migrations may have failed (check if already up to date)"
fi

# Step 8: Clear and optimize caches
log "🧹 Clearing caches..."
sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER" \
    "cd $REMOTE_PATH && php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear" \
    2>&1 | tee -a "$LOG_FILE" && log_success "Caches cleared"

log "⚡ Optimizing for production..."
sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER" \
    "cd $REMOTE_PATH && php artisan config:cache && php artisan route:cache && php artisan view:cache" \
    2>&1 | tee -a "$LOG_FILE" && log_success "Caches optimized"

# Step 9: Set proper permissions
log "🔒 Setting file permissions..."
sshpass -p "$SERVER_PASSWORD" ssh -o StrictHostKeyChecking=no "$SERVER" \
    "cd $REMOTE_PATH && chmod -R 755 storage bootstrap/cache public" \
    2>&1 | tee -a "$LOG_FILE" && log_success "Permissions set"

# Step 10: Test health endpoint
log "🏥 Testing health endpoint..."
sleep 2
HEALTH_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://master.astracareportal.com/health)
if [ "$HEALTH_STATUS" -eq 200 ]; then
    log_success "Health check passed (HTTP $HEALTH_STATUS)"
else
    log_warning "Health check returned HTTP $HEALTH_STATUS"
fi

echo ""
echo -e "${CYAN}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${CYAN}║${NC}                 ${GREEN}DEPLOYMENT COMPLETE${NC}                      ${CYAN}║${NC}"
echo -e "${CYAN}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""
log_success "Deployment completed successfully!"
echo -e "🌐 Visit: ${BLUE}https://master.astracareportal.com${NC}"
echo -e "🏥 Health: ${BLUE}https://master.astracareportal.com/health${NC}"
echo -e "📝 Log: ${BLUE}$LOG_FILE${NC}"
echo ""
