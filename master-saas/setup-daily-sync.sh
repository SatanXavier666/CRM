#!/bin/bash

###############################################################################
# Setup Daily Automatic Sync to Hostinger
# This script sets up a cron job to automatically sync changes daily
###############################################################################

SCRIPT_PATH="/root/repo/master-saas/sync-to-hostinger.sh"
CRON_TIME="0 2 * * *"  # Run at 2 AM daily

echo "Setting up daily automatic sync to Hostinger..."

# Make sync script executable
chmod +x "$SCRIPT_PATH"

# Check if cron job already exists
if crontab -l 2>/dev/null | grep -q "sync-to-hostinger.sh"; then
    echo "✓ Cron job already exists"
    echo "Current cron jobs:"
    crontab -l | grep "sync-to-hostinger.sh"
else
    # Add cron job
    (crontab -l 2>/dev/null; echo "$CRON_TIME $SCRIPT_PATH >> /root/repo/master-saas/deployment.log 2>&1") | crontab -
    echo "✓ Cron job added successfully"
    echo "Deployment will run daily at 2:00 AM"
fi

echo ""
echo "You can also run manual deployment anytime with:"
echo "  bash $SCRIPT_PATH"
echo ""
echo "To view deployment logs:"
echo "  tail -f /root/repo/master-saas/deployment.log"
echo ""
