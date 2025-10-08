# 🚀 Hostinger Deployment Guide - AstraCare Portal

## 📋 Overview

This guide explains how to deploy and maintain the AstraCare Portal on Hostinger. All changes are automatically synced to Hostinger instead of GitHub.

---

## 🎯 New Features Added

### ✅ Server Status Footer
A real-time status bar at the bottom of every page showing:
- **System Status** with color indicators:
  - 🟢 **Green** - All Systems Operational
  - 🟡 **Yellow** - Partial System Outage
  - 🔴 **Red** - System Outage
- **Component Status** (Database, Cache, Storage)
- **Server Location** (Hostinger • srv602)
- **Uptime** percentage
- **Auto-refresh** every 30 seconds
- **Manual refresh** button

### ✅ Health Check Endpoint
- **URL:** `https://master.astracareportal.com/health`
- **Returns:** JSON with system status
- **Checks:**
  - Database connectivity
  - Cache functionality
  - Storage writability
  - System version

---

## 📦 Deployment Options

### Option 1: Automatic Daily Sync (Recommended)

**Setup Once:**
```bash
cd /root/repo/master-saas
bash setup-daily-sync.sh
```

This creates a cron job that runs daily at 2:00 AM to sync all changes to Hostinger.

**Manual Trigger:**
```bash
bash /root/repo/master-saas/sync-to-hostinger.sh
```

### Option 2: Manual Deployment via Package

**Latest Package:** `/tmp/server-status-update.tar.gz` (101 KB)

**Steps:**

1. **Upload to Hostinger via cPanel:**
   - Login: https://hpanel.hostinger.com
   - Go to File Manager
   - Navigate to: `/home/u458200173/`
   - Upload `server-status-update.tar.gz`

2. **Extract Files:**
   - SSH or use Terminal in cPanel:
   ```bash
   cd /home/u458200173/
   tar -xzf server-status-update.tar.gz -C domains/master.astracareportal.com/private_html/
   ```

3. **Clear Caches:**
   ```bash
   cd /home/u458200173/domains/master.astracareportal.com/private_html
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   php artisan config:cache
   php artisan route:cache
   ```

4. **Set Permissions:**
   ```bash
   chmod -R 755 storage bootstrap/cache public
   ```

### Option 3: Direct File Upload via cPanel

Upload these files directly via File Manager:

```
📁 public/build/              → All compiled assets
📁 resources/js/              → Vue components + ServerStatus.vue
📄 routes/web.php             → Health check endpoint
```

---

## 🔧 Automated Sync Script Features

The `sync-to-hostinger.sh` script automatically:

1. ✅ Deploys compiled frontend assets
2. ✅ Syncs Vue components
3. ✅ Updates routes
4. ✅ Deploys configuration files
5. ✅ Syncs public assets
6. ✅ Runs database migrations
7. ✅ Clears all caches
8. ✅ Optimizes for production
9. ✅ Sets proper permissions
10. ✅ Tests health endpoint

**Log File:** `/root/repo/master-saas/deployment.log`

**View Logs:**
```bash
tail -f /root/repo/master-saas/deployment.log
```

---

## 🗄️ Database Configuration

**Already configured in `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u458200173_Jithin
DB_USERNAME=u458200173_Jithin
DB_PASSWORD=Jithin@123456789
```

**Important:** Ensure the MySQL database `u458200173_Jithin` exists in Hostinger MySQL panel.

---

## 🏥 Health Check Monitoring

### Endpoint Details

**URL:** `https://master.astracareportal.com/health`

**Response Example:**
```json
{
  "status": "operational",
  "timestamp": "2025-10-08T08:45:00+00:00",
  "checks": {
    "database": {
      "status": "operational",
      "message": "Connected"
    },
    "cache": {
      "status": "operational",
      "message": "Working"
    },
    "storage": {
      "status": "operational",
      "message": "Writable"
    }
  },
  "version": "1.0.0"
}
```

### Status Values
- `operational` - All systems working
- `degraded` - Some systems have issues
- `outage` - Critical failure

### Testing Health Check
```bash
curl https://master.astracareportal.com/health
```

---

## 📊 Server Status Footer

### Features
- **Fixed bottom bar** on all pages
- **Color-coded indicators:**
  - 🟢 Green = Operational
  - 🟡 Yellow = Degraded
  - 🔴 Red = Outage
- **Component breakdown:**
  - Database status
  - Cache status
  - Storage status
- **Auto-refresh** every 30 seconds
- **Manual refresh** button
- **Responsive design** (adapts to mobile)

### Visual Preview
```
╔═══════════════════════════════════════════════════════════════════════╗
║ 🟢 All Systems Operational  •Database •Cache •Storage  |  Refresh  ║
╚═══════════════════════════════════════════════════════════════════════╝
```

---

## 🔄 Daily Workflow

### What Happens Automatically
1. **2:00 AM Daily** - Cron job runs sync script
2. **Automatic Sync** - All local changes deploy to Hostinger
3. **Cache Clear** - Production caches refreshed
4. **Health Check** - System validates deployment
5. **Logging** - Results saved to deployment.log

### Manual Changes Process
1. Make changes locally in `/root/repo/master-saas`
2. Build frontend: `npm run build`
3. Run sync: `bash sync-to-hostinger.sh`
4. Verify: Visit https://master.astracareportal.com

---

## 📁 File Structure

```
/root/repo/master-saas/
├── sync-to-hostinger.sh          # Main deployment script
├── setup-daily-sync.sh            # Cron job setup
├── deployment.log                 # Deployment history
├── public/build/                  # Compiled assets
├── resources/js/
│   ├── Components/
│   │   └── ServerStatus.vue      # Status footer component
│   └── Pages/
│       ├── Welcome.vue            # Landing page (with status)
│       └── Login.vue              # Login page (with status)
└── routes/web.php                 # Routes (includes /health)
```

---

## 🛠️ Troubleshooting

### Status Bar Not Showing
```bash
# Clear browser cache (Ctrl+Shift+R)
# On server:
cd /home/u458200173/domains/master.astracareportal.com/private_html
php artisan view:clear
php artisan cache:clear
```

### Health Endpoint Returns 500
```bash
# Check database connection
php artisan config:clear
php artisan migrate --force

# Check logs
tail -f storage/logs/laravel.log
```

### Deployment Script Fails
```bash
# Check SSH connectivity
ssh u458200173@srv602.hstgr.io "echo 'Connection OK'"

# Check rsync installation
which rsync sshpass

# View detailed logs
cat /root/repo/master-saas/deployment.log
```

### Database Connection Issues
1. Verify database exists in Hostinger panel
2. Check `.env` credentials match
3. Run: `php artisan config:clear`
4. Test: `php artisan tinker` then `DB::connection()->getPdo();`

---

## 🔐 Security Notes

### Credentials Management
- Server password stored in sync script
- Database credentials in `.env`
- Never commit sensitive data to GitHub
- All deployments go to Hostinger directly

### File Permissions
```bash
# Correct permissions:
chmod -R 755 storage bootstrap/cache
chmod -R 755 public
chmod 644 .env
```

---

## 📈 Monitoring

### Check Deployment Status
```bash
# View recent deployments
tail -20 /root/repo/master-saas/deployment.log

# Check cron job
crontab -l | grep sync-to-hostinger

# Test health endpoint
curl -s https://master.astracareportal.com/health | jq
```

### Monitor Server Status
- Visit: https://master.astracareportal.com
- Check footer: Should show 🟢 Green
- Click refresh to update status

---

## 🎯 Next Steps

### After Deployment

1. **Verify Status Bar:**
   - Visit https://master.astracareportal.com
   - Check bottom of page for status bar
   - Should show "All Systems Operational" in green

2. **Test Health Check:**
   ```bash
   curl https://master.astracareportal.com/health
   ```

3. **Check Component Status:**
   - All indicators should be green
   - Database, Cache, Storage all operational

4. **Setup Monitoring:**
   - Add uptime monitoring service
   - Configure alerts for status changes
   - Monitor deployment logs

### Recommended Tools

**Uptime Monitoring:**
- UptimeRobot (free)
- Pingdom
- StatusCake

**Setup Example:**
- Monitor URL: `https://master.astracareportal.com/health`
- Check interval: 5 minutes
- Alert on: HTTP != 200 or status != "operational"

---

## 📞 Quick Reference

### Key URLs
- **Website:** https://master.astracareportal.com
- **Login:** https://master.astracareportal.com/login
- **Health:** https://master.astracareportal.com/health

### Key Commands
```bash
# Manual deployment
bash /root/repo/master-saas/sync-to-hostinger.sh

# Build frontend
cd /root/repo/master-saas && npm run build

# View logs
tail -f /root/repo/master-saas/deployment.log

# Setup daily sync
bash /root/repo/master-saas/setup-daily-sync.sh
```

### Server Details
- **Host:** srv602.hstgr.io
- **User:** u458200173
- **Domain:** master.astracareportal.com
- **Path:** `/home/u458200173/domains/master.astracareportal.com/private_html`

---

## ✅ Deployment Checklist

- [x] Health check endpoint created (`/health`)
- [x] Server status component built (`ServerStatus.vue`)
- [x] Status bar added to all pages
- [x] Automatic sync script created
- [x] Daily cron job setup available
- [x] Deployment package created (101 KB)
- [x] Documentation completed
- [ ] Deploy to Hostinger
- [ ] Verify status indicators work
- [ ] Setup daily sync cron job
- [ ] Configure uptime monitoring

---

**Built with ❤️ by Terragon Labs**

All changes automatically sync to Hostinger • No GitHub required
