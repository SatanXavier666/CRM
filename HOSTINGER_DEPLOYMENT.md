# Hosting on Hostinger - Complete Guide

This guide will walk you through deploying the micro.so clone to Hostinger hosting.

## Prerequisites

- Active Hostinger hosting account (shared, cloud, or VPS)
- FTP/SFTP credentials from Hostinger
- Your domain configured in Hostinger (optional but recommended)

## Method 1: File Manager (Easiest)

### Step 1: Download the Repository

1. Go to your GitHub repository: `https://github.com/SatanXavier666/CRM`
2. Click the green "Code" button
3. Select "Download ZIP"
4. Extract the ZIP file on your computer

### Step 2: Upload via Hostinger File Manager

1. Log in to Hostinger control panel (hPanel)
2. Navigate to **Files → File Manager**
3. Go to `public_html` directory (or your domain's document root)
4. Click **Upload Files** button
5. Select ALL files and folders from the extracted ZIP
6. Wait for upload to complete (may take 10-15 minutes due to large images)

### Step 3: Set Permissions

1. In File Manager, select all uploaded files
2. Right-click → **Permissions**
3. Set folders to **755**
4. Set files to **644**

### Step 4: Configure Domain

If using a custom domain:
1. Go to **Domains** in hPanel
2. Point your domain to the `public_html` directory
3. Wait for DNS propagation (up to 24 hours)

Your site should now be live!

---

## Method 2: FTP/SFTP (Recommended for Large Sites)

### Step 1: Get FTP Credentials

1. Log in to Hostinger hPanel
2. Go to **Files → FTP Accounts**
3. Create new FTP account or use existing
4. Note down:
   - **Hostname** (usually ftp.yourdomain.com)
   - **Username**
   - **Password**
   - **Port** (21 for FTP, 22 for SFTP)

### Step 2: Download FTP Client

Download and install **FileZilla** (free):
- https://filezilla-project.org/download.php?type=client

### Step 3: Connect to Your Server

1. Open FileZilla
2. Enter your FTP credentials:
   - Host: `ftp.yourdomain.com`
   - Username: Your FTP username
   - Password: Your FTP password
   - Port: 21
3. Click **Quickconnect**

### Step 4: Upload Files

1. In FileZilla's left panel (local), navigate to your downloaded repository
2. In right panel (remote), navigate to `public_html`
3. Select all files and folders from local panel
4. Right-click → **Upload**
5. Wait for transfer to complete (10-20 minutes depending on internet speed)

---

## Method 3: Git Deployment (Advanced - Requires SSH Access)

### Prerequisites
- VPS or Business hosting plan with SSH access
- SSH credentials from Hostinger

### Step 1: Connect via SSH

```bash
ssh your-username@your-server-ip
```

### Step 2: Navigate to Web Directory

```bash
cd public_html
```

### Step 3: Clone Repository

```bash
git clone https://github.com/SatanXavier666/CRM.git .
```

### Step 4: Set Permissions

```bash
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
```

### Step 5: Set Up Auto-Deploy (Optional)

Create a deploy script:

```bash
nano deploy.sh
```

Add:

```bash
#!/bin/bash
cd /home/your-username/public_html
git pull origin main
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
```

Make executable:

```bash
chmod +x deploy.sh
```

---

## Post-Deployment Configuration

### 1. Create .htaccess for Clean URLs

Create `/public_html/.htaccess`:

```apache
# Enable rewrite engine
RewriteEngine On

# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Remove .html extension
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.html -f
RewriteRule ^(.*)$ $1.html [L]

# Custom error pages
ErrorDocument 404 /index.html
ErrorDocument 403 /index.html

# Disable directory browsing
Options -Indexes

# Set default charset
AddDefaultCharset UTF-8

# Enable compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Browser caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/font-woff2 "access plus 1 year"
</IfModule>

# Security headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
</IfModule>
```

### 2. Verify File Structure

Ensure your directory structure looks like this:

```
public_html/
├── _next/
│   ├── static/
│   │   ├── css/
│   │   ├── chunks/
│   │   └── media/
│   │       ├── Background.9321a94d.png  ✓
│   │       ├── Foreground.c9666dea.png  ✓
│   │       └── ... (other assets)
│   └── image/
│       └── index.html
├── videos/
│   └── posters/
├── static/
├── index.html
├── privacy.html
├── terms.html
├── waitlist.html
├── fix_images.js
├── favicon.ico
├── manifest.webmanifest
└── .htaccess
```

### 3. Test Your Site

Visit your domain:
- Homepage: `https://yourdomain.com`
- Privacy: `https://yourdomain.com/privacy`
- Terms: `https://yourdomain.com/terms`
- Waitlist: `https://yourdomain.com/waitlist`

---

## Troubleshooting

### Images Not Loading

**Problem**: Background images or other images not appearing

**Solutions**:
1. Check browser console (F12) for errors
2. Verify `fix_images.js` is loading correctly
3. Check file permissions (should be 644 for images)
4. Clear browser cache (Ctrl+Shift+R)
5. Ensure `Background.9321a94d.png` and `Foreground.c9666dea.png` exist in `_next/static/media/`

### 404 Errors

**Problem**: Pages return 404 errors

**Solutions**:
1. Verify `.htaccess` file exists and is properly configured
2. Check that `mod_rewrite` is enabled (contact Hostinger support if needed)
3. Ensure HTML files are in the root directory

### Slow Loading

**Problem**: Site loads slowly

**Solutions**:
1. Enable compression in `.htaccess` (see above)
2. Use Hostinger's CDN feature (if available in your plan)
3. Enable browser caching (already in `.htaccess` above)
4. Consider upgrading to faster hosting plan

### CSS/JS Not Loading

**Problem**: Styles or scripts don't work

**Solutions**:
1. Check file permissions (should be 644)
2. Verify paths in HTML are correct (relative, not absolute)
3. Clear Hostinger cache (in hPanel → Performance → Cache Manager)
4. Check `.htaccess` for conflicts

---

## Performance Optimization

### Enable Hostinger CDN

1. Go to hPanel → **Performance → CDN**
2. Enable Cloudflare integration
3. Configure settings for your domain

### Enable Caching

1. Go to hPanel → **Performance → Cache Manager**
2. Enable caching for your domain
3. Set cache duration to 1 month for static assets

### Compress Images (Already Done)

The images are already optimized, but if you add new ones:
1. Use tools like TinyPNG or Squoosh
2. Convert to WebP format when possible
3. Use appropriate dimensions (don't upload oversized images)

---

## Custom Domain Setup

### If You Have a Domain

1. Go to hPanel → **Domains**
2. Click **Add Domain**
3. Enter your domain name
4. Point nameservers to Hostinger:
   - ns1.dns-parking.com
   - ns2.dns-parking.com
5. Wait 24-48 hours for DNS propagation

### SSL Certificate (HTTPS)

1. Go to hPanel → **Security → SSL**
2. Select your domain
3. Click **Install SSL** (free Let's Encrypt)
4. Wait 10-15 minutes for activation
5. Enable "Force HTTPS" option

---

## Maintenance

### Updating the Site

#### Via File Manager:
1. Delete old files
2. Upload new files

#### Via FTP:
1. Connect with FileZilla
2. Upload changed files
3. Overwrite when prompted

#### Via Git (SSH):
```bash
cd public_html
./deploy.sh
```

### Backup

1. Go to hPanel → **Files → Backups**
2. Create manual backup before major updates
3. Download backup file to your computer
4. Or use Hostinger's automatic weekly backups

---

## Support

### Hostinger Support

- Live Chat: Available 24/7 in hPanel
- Email: support@hostinger.com
- Knowledge Base: https://support.hostinger.com

### Common Issues Database

- **Error 500**: Check `.htaccess` syntax
- **Permission Denied**: Set correct file permissions (755/644)
- **Site Not Loading**: Check domain DNS settings
- **Slow Performance**: Enable CDN and caching

---

## Estimated Deployment Time

- **File Manager**: 15-20 minutes
- **FTP Upload**: 15-25 minutes (depending on internet speed)
- **Git Deployment**: 5-10 minutes (requires SSH)

---

## Cost Estimate

- **Single Shared Hosting**: $2-5/month (suitable for low traffic)
- **Premium Shared Hosting**: $5-10/month (recommended)
- **Cloud Hosting**: $10-30/month (for higher traffic)
- **VPS Hosting**: $30+/month (for maximum performance)

---

## Next Steps

1. ✅ Upload files to Hostinger
2. ✅ Configure `.htaccess`
3. ✅ Set up SSL certificate
4. ✅ Test all pages
5. ✅ Enable CDN and caching
6. ✅ Configure custom domain
7. ✅ Set up automatic backups

**Your exact clone of micro.so is now live on Hostinger!** 🎉
