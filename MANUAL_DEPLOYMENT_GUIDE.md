# 📦 Manual Deployment Guide - Hostinger

Since GitHub Actions is having connectivity issues with Hostinger FTP/SSH, here's the simplest manual deployment method.

## ✅ What You Need

- Deployment package: `/tmp/astracare-deploy-final.tar.gz` (102 KB)
- Hostinger cPanel access
- 5 minutes

---

## 🚀 Quick Deployment (3 Steps)

### Step 1: Download Package

Download this file from the server:
```
/tmp/astracare-deploy-final.tar.gz (102 KB)
```

### Step 2: Upload to Hostinger

1. Login: https://hpanel.hostinger.com
2. Open **File Manager**
3. Navigate to: `/home/u458200173/`
4. Click **Upload** button
5. Select `astracare-deploy-final.tar.gz`
6. Wait for upload to complete

### Step 3: Extract Files

**Option A: Via File Manager**
1. Right-click `astracare-deploy-final.tar.gz`
2. Click **Extract**
3. Extract to: `domains/master.astracareportal.com/private_html/`
4. Click **Extract**

**Option B: Via Terminal** (in cPanel)
```bash
cd /home/u458200173
tar -xzf astracare-deploy-final.tar.gz -C domains/master.astracareportal.com/private_html/
```

### Step 4: Clear Caches

In cPanel Terminal:
```bash
cd /home/u458200173/domains/master.astracareportal.com/private_html
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
```

---

## ✨ Verify Deployment

**Homepage:** https://master.astracareportal.com
- Should show dark theme with neon effects
- Animated floating orbs
- Server status bar at bottom: 🟢

**Health Check:** https://master.astracareportal.com/health
- Should return JSON with system status

**Login:** https://master.astracareportal.com/login
- Premium design with credential cards

---

## 🔄 Future Updates

For quick updates, you only need to upload these specific files:

### Frontend Updates
```
Local: master-saas/public/build/
→ Server: /home/u458200173/domains/master.astracareportal.com/private_html/public/build/
```

### Component Updates
```
Local: master-saas/resources/js/
→ Server: /home/u458200173/domains/master.astracareportal.com/private_html/resources/js/
```

### Route Updates
```
Local: master-saas/routes/web.php
→ Server: /home/u458200173/domains/master.astracareportal.com/private_html/routes/web.php
```

After uploading, always run:
```bash
php artisan optimize:clear
```

---

## 📋 What's in the Package

```
public/build/assets/          - Compiled frontend (Vue + Tailwind)
├── app-D9lKiqQ7.js          - Main app (223 KB)
├── app-CDidiso4.css         - Tailwind styles (42 KB)
├── Welcome-DEhIopcH.js      - Landing page (14 KB)
├── Login-BBzNd6H5.js        - Login page (14 KB)
└── ServerStatus-CtAHUO7-.js - Status component (4.5 KB)

resources/js/
├── Components/
│   └── ServerStatus.vue     - Server status footer
└── Pages/
    ├── Welcome.vue          - Premium landing page
    └── Login.vue            - Premium login page

routes/web.php               - Health check endpoint

.env                         - Database configuration
```

---

## 🎨 What You'll See

### Premium UI Features
- **Dark gradient background** (slate → purple → cyan)
- **Animated floating orbs** (purple, cyan, pink)
- **Rising particle animations**
- **Neon glowing effects** on buttons and cards
- **Glassmorphism design** with backdrop blur
- **Color-coded credential cards** on login
- **Server status bar** with real-time health

### Server Status Indicators
- 🟢 **Green** - All systems operational
- 🟡 **Yellow** - Warning / degraded
- 🔴 **Red** - Error / down

---

## 🛠️ Troubleshooting

### Old site still showing
```bash
# Clear browser cache
Press: Ctrl + Shift + R

# Clear server caches
php artisan optimize:clear
```

### Premium UI not visible
```bash
# Check if files deployed
ls -la public/build/assets/ | grep Welcome

# Clear view cache
php artisan view:clear
```

### Health endpoint 404
```bash
# Clear route cache
php artisan route:clear
php artisan route:cache

# Verify route exists
php artisan route:list | grep health
```

### Status bar not showing
```bash
# Check ServerStatus component
ls -la resources/js/Components/

# Re-compile assets (if needed)
npm run build
```

---

## 🔐 Credentials

**Hostinger Panel:** https://hpanel.hostinger.com

**Database:**
- Host: 127.0.0.1
- Database: u458200173_Jithin
- Username: u458200173_Jithin
- Password: Jithin@123456789

**FTP/SFTP:**
- Server: srv602.hstgr.io
- Username: u458200173
- Password: T3rr@g0n@2025
- Port: 21 (FTP) / 22 (SFTP)

---

## ⚡ Alternative: Direct FTP Upload

If you prefer FTP client (FileZilla, WinSCP, etc.):

1. **Connect:**
   - Host: `srv602.hstgr.io`
   - Username: `u458200173`
   - Password: `T3rr@g0n@2025`
   - Port: `21` or `22`

2. **Navigate to:**
   ```
   /home/u458200173/domains/master.astracareportal.com/private_html/
   ```

3. **Upload these folders:**
   - `public/build/` (overwrite all)
   - `resources/js/Pages/` (overwrite all)
   - `resources/js/Components/` (overwrite all)
   - `routes/web.php` (overwrite)

4. **Clear caches via cPanel Terminal**

---

## 📞 Support

**Hostinger Support:** https://support.hostinger.com

**GitHub Repository:** https://github.com/SatanXavier666/CRM

**Deployment Package:** `/tmp/astracare-deploy-final.tar.gz`

---

**This is the fastest and most reliable deployment method until GitHub Actions FTP connectivity is resolved.** 🚀

Built with ❤️ by Terragon Labs
