# 🚀 GitHub to Hostinger Auto-Deployment Setup

This guide explains how to set up automatic deployment from GitHub to your Hostinger server.

## 📋 Overview

When you push code to the `main` branch, GitHub Actions will automatically:
1. ✅ Build your Laravel application
2. ✅ Compile frontend assets (Vue + Tailwind)
3. ✅ Deploy files to Hostinger via FTP/SFTP
4. ✅ Run post-deployment commands (clear caches, optimize)
5. ✅ Set proper permissions

---

## 🔐 Step 1: Add GitHub Secrets

You need to add your Hostinger credentials as GitHub secrets:

### Go to GitHub Repository Settings
1. Open: https://github.com/SatanXavier666/CRM
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**

### Add These Secrets

#### FTP/SFTP Credentials
```
Name: HOSTINGER_FTP_SERVER
Value: srv602.hstgr.io
```

```
Name: HOSTINGER_FTP_USERNAME
Value: u458200173
```

```
Name: HOSTINGER_FTP_PASSWORD
Value: T3rr@g0n@2025
```

#### SSH Credentials (for post-deployment commands)
```
Name: HOSTINGER_SSH_HOST
Value: srv602.hstgr.io
```

```
Name: HOSTINGER_SSH_USERNAME
Value: u458200173
```

```
Name: HOSTINGER_SSH_PASSWORD
Value: T3rr@g0n@2025
```

```
Name: HOSTINGER_SSH_PORT
Value: 22
```

---

## 📁 Step 2: Verify Workflow File

The workflow file has been created at:
```
.github/workflows/deploy-hostinger.yml
```

This workflow will:
- Trigger on push to `main` branch
- Can also be triggered manually from GitHub Actions tab
- Build and deploy your entire application

---

## 🧪 Step 3: Test the Deployment

### Option A: Merge Your PR
```bash
gh pr merge 3 --squash
```

This will merge your feature branch to `main` and trigger the deployment.

### Option B: Manual Trigger
1. Go to: https://github.com/SatanXavier666/CRM/actions
2. Click **Deploy to Hostinger** workflow
3. Click **Run workflow** → **Run workflow**

### Option C: Push to Main
```bash
git checkout main
git merge feature/laravel-saas-platform
git push origin main
```

---

## 📊 Step 4: Monitor Deployment

### Watch the Deployment
1. Go to: https://github.com/SatanXavier666/CRM/actions
2. Click on the latest workflow run
3. Watch each step execute in real-time

### Deployment Steps
```
✓ Checkout code
✓ Setup PHP 8.2
✓ Setup Node.js 20
✓ Install Composer dependencies
✓ Install NPM dependencies
✓ Build frontend assets (Vue + Tailwind)
✓ Create deployment package
✓ Deploy to Hostinger via SFTP
✓ Run post-deployment commands
  - Clear caches
  - Cache config/routes
  - Set permissions
✓ Deployment notification
```

---

## ✅ Step 5: Verify Deployment

After the workflow completes, verify:

1. **Homepage**
   - Visit: https://master.astracareportal.com
   - Should show: Dark theme, neon effects, animated orbs
   - Status bar: 🟢 All Systems Operational

2. **Health Endpoint**
   - Visit: https://master.astracareportal.com/health
   - Should return: JSON with system status

3. **Login Page**
   - Visit: https://master.astracareportal.com/login
   - Should show: Premium design with credential cards

---

## 🔧 Troubleshooting

### Deployment Fails: FTP Connection Error
**Problem:** Can't connect to Hostinger FTP
**Solution:**
- Verify FTP credentials in Hostinger panel
- Check if FTP is enabled for your account
- Try SFTP port 22 instead of FTP port 21

### Deployment Fails: SSH Permission Denied
**Problem:** Can't run post-deployment commands
**Solution:**
- Verify SSH is enabled in Hostinger panel
- Some Hostinger plans don't support SSH
- If SSH unavailable, remove the SSH step from workflow

### Files Not Updating
**Problem:** Old version still showing after deployment
**Solution:**
- Check GitHub Actions logs for errors
- Clear browser cache (Ctrl + Shift + R)
- Verify files uploaded to correct directory

### Permission Errors
**Problem:** 500 error after deployment
**Solution:**
- Check storage folder permissions
- Add manual permission fix via Hostinger File Manager:
  ```bash
  chmod -R 755 storage bootstrap/cache
  chmod 644 .env
  ```

---

## 🎯 Alternative: Manual FTP Deployment

If GitHub Actions doesn't work, you can deploy manually via FTP:

### Using FileZilla (or any FTP client)
1. **Connect:**
   - Host: `srv602.hstgr.io`
   - Username: `u458200173`
   - Password: `T3rr@g0n@2025`
   - Port: `21` (FTP) or `22` (SFTP)

2. **Navigate to:**
   - Remote: `/home/u458200173/domains/master.astracareportal.com/private_html/`

3. **Upload:**
   - Upload `master-saas/public/build/` → `public/build/`
   - Upload `master-saas/resources/js/` → `resources/js/`
   - Upload `master-saas/routes/web.php` → `routes/web.php`
   - Upload `master-saas/.env` → `.env`

4. **Clear Caches** (via cPanel Terminal):
   ```bash
   cd /home/u458200173/domains/master.astracareportal.com/private_html
   php artisan optimize:clear
   ```

---

## 📝 Workflow Configuration Details

### Triggers
- **Automatic:** Push to `main` branch
- **Manual:** Workflow dispatch (from Actions tab)

### What Gets Deployed
```
✓ Compiled frontend assets (public/build/)
✓ Vue components (resources/js/)
✓ Routes (routes/)
✓ Controllers (app/Http/Controllers/)
✓ Models (app/Models/)
✓ Views (resources/views/)
✓ Configuration files
✓ Composer dependencies (vendor/)
```

### What Doesn't Get Deployed
```
✗ .git folder
✗ node_modules
✗ tests
✗ .env.example
✗ Storage logs/cache
```

---

## 🔒 Security Notes

### Protect Your Secrets
- ✅ Secrets are encrypted in GitHub
- ✅ Not visible in logs or workflow runs
- ✅ Only accessible during workflow execution

### Best Practices
- Use strong passwords
- Rotate credentials regularly
- Enable 2FA on GitHub
- Limit FTP access to specific directories
- Use SFTP instead of FTP when possible

---

## 🚀 Future Enhancements

### Add Environment Variables
Add Laravel `.env` variables as GitHub secrets:
```
LARAVEL_APP_KEY
LARAVEL_DB_PASSWORD
STRIPE_KEY
STRIPE_SECRET
```

Then update deployment to create `.env` file dynamically.

### Add Database Migrations
Add step to run migrations automatically:
```yaml
- name: Run migrations
  run: |
    cd /home/u458200173/domains/master.astracareportal.com/private_html
    php artisan migrate --force
```

### Add Slack Notifications
Get notified when deployment completes:
```yaml
- name: Slack notification
  uses: 8398a7/action-slack@v3
  with:
    status: ${{ job.status }}
    webhook_url: ${{ secrets.SLACK_WEBHOOK }}
```

---

## 📞 Quick Reference

**GitHub Repository:** https://github.com/SatanXavier666/CRM

**GitHub Actions:** https://github.com/SatanXavier666/CRM/actions

**Hostinger Panel:** https://hpanel.hostinger.com

**Live Site:** https://master.astracareportal.com

**Workflow File:** `.github/workflows/deploy-hostinger.yml`

---

## ✅ Checklist

Before first deployment:
- [ ] Add all GitHub secrets
- [ ] Verify FTP credentials work
- [ ] Test SSH connection (if available)
- [ ] Push workflow file to `main` branch
- [ ] Trigger first deployment
- [ ] Verify site updates correctly
- [ ] Check GitHub Actions logs

---

**Your automatic deployment is ready! Just add the GitHub secrets and merge your PR to main.** 🚀

Built with ❤️ by Terragon Labs
