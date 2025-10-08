# 🔑 Demo Login Credentials - AstraCare Portal

## 🌐 Demo Site Access

**Live Demo Site**: https://master.astracareportal.com
**Login Page**: https://master.astracareportal.com/login
**Demo Page**: https://master.astracareportal.com/demo

---

## 👥 Demo User Accounts

### 🔴 Super Admin (Full System Access)

```
Email: admin@astracareportal.com
Password: admin123
Role: Super Administrator
Permissions: ALL
```

**Access Level:**
- ✅ Full system administration
- ✅ Manage all tenants
- ✅ Manage all users
- ✅ Billing management
- ✅ System settings
- ✅ CRM & ERP modules
- ✅ All reports and analytics

---

### 🔵 Administrator

```
Email: john.admin@astracareportal.com
Password: admin123
Name: John Anderson
Role: Administrator
```

**Access Level:**
- ✅ User management
- ✅ Billing management
- ✅ CRM module (full access)
- ✅ ERP module (full access)
- ✅ Reports and analytics
- ✅ Settings management
- ❌ Tenant management (limited)

---

### 🟢 Manager

```
Email: sarah.manager@astracareportal.com
Password: manager123
Name: Sarah Johnson
Role: Manager
```

**Access Level:**
- ✅ Dashboard access
- ✅ CRM module (manage)
- ✅ ERP module (manage)
- ✅ View reports
- ❌ User management
- ❌ Billing management
- ❌ System settings

---

### ⚪ Regular User

```
Email: mike.user@astracareportal.com
Password: user123
Name: Mike Davis
Role: User
```

**Access Level:**
- ✅ Dashboard access
- ✅ CRM module (view only)
- ✅ ERP module (view only)
- ❌ Reports (limited)
- ❌ Management functions
- ❌ Settings

---

## 👤 Additional Demo Users

### Emily Chen (Manager)
```
Email: emily.chen@astracareportal.com
Password: demo123
Role: Manager
```

### Robert Wilson (User)
```
Email: robert.wilson@astracareportal.com
Password: demo123
Role: User
```

### Lisa Martinez (User)
```
Email: lisa.martinez@astracareportal.com
Password: demo123
Role: User
```

---

## 🚀 How to Enable Login

### Step 1: Install Laravel Breeze

```bash
# SSH into your server
ssh -p 65002 u458200173@145.79.210.26

# Navigate to project
cd /home/u458200173/domains/astracareportal.com/public_html/master.astracareportal.com

# Install Breeze
composer require laravel/breeze --dev
php artisan breeze:install vue

# Build assets
npm install
npm run build

# Clear caches
php artisan optimize:clear
php artisan optimize
```

### Step 2: Run Database Seeders

```bash
# Run the demo data seeder
php artisan db:seed --class=DemoDataSeeder

# Or run all seeders
php artisan db:seed
```

### Step 3: Verify Users

```bash
# Check created users
php artisan tinker
User::count();
User::all()->pluck('email', 'name');
exit
```

---

## 📊 User Roles & Permissions

### Permissions List:

1. **view-dashboard** - Access dashboard
2. **manage-users** - Create, edit, delete users
3. **manage-tenants** - Manage tenant accounts
4. **manage-billing** - Handle billing and subscriptions
5. **view-crm** - View CRM module
6. **manage-crm** - Manage CRM data
7. **view-erp** - View ERP module
8. **manage-erp** - Manage ERP data
9. **view-reports** - Access reports
10. **manage-settings** - System settings

### Role Assignments:

| Role | Permissions |
|------|------------|
| **Super Admin** | ALL permissions |
| **Admin** | All except manage-tenants |
| **Manager** | Dashboard, CRM, ERP, Reports (view & manage) |
| **User** | Dashboard, CRM, ERP (view only) |

---

## 🧪 Testing Demo Accounts

### Test Super Admin:

```bash
# Login with super admin credentials
Email: admin@astracareportal.com
Password: admin123

# Expected: Full access to all features
```

### Test Regular User:

```bash
# Login with user credentials
Email: mike.user@astracareportal.com
Password: user123

# Expected: Limited access, view-only permissions
```

---

## 🔐 Security Notes

### ⚠️ Important:

1. **Production Use**: These are DEMO credentials only
2. **Change Passwords**: Update all passwords before going live
3. **Delete Demo Users**: Remove demo accounts in production
4. **Strong Passwords**: Use complex passwords for real users
5. **2FA**: Enable two-factor authentication for admins

### Recommended Actions:

```bash
# To delete demo users later
php artisan tinker
User::whereIn('email', [
    'admin@astracareportal.com',
    'john.admin@astracareportal.com',
    'sarah.manager@astracareportal.com',
    'mike.user@astracareportal.com'
])->delete();
```

---

## 📝 Quick Access Links

| Link | Purpose |
|------|---------|
| https://master.astracareportal.com | Homepage |
| https://master.astracareportal.com/login | Login page |
| https://master.astracareportal.com/demo | Demo credentials |
| https://master.astracareportal.com/dashboard | Dashboard (after auth) |

---

## 🛠️ Troubleshooting

### Can't Login?

1. **Verify users exist:**
   ```bash
   php artisan tinker
   User::where('email', 'admin@astracareportal.com')->first();
   ```

2. **Re-run seeders:**
   ```bash
   php artisan db:seed --class=DemoDataSeeder
   ```

3. **Check authentication:**
   ```bash
   # Ensure Breeze is installed
   php artisan route:list | grep login
   ```

### Password Not Working?

```bash
# Reset a user password
php artisan tinker
$user = User::where('email', 'admin@astracareportal.com')->first();
$user->password = Hash::make('newpassword123');
$user->save();
```

---

## 📚 Related Documentation

- **QUICK_START.md** - Getting started guide
- **SETUP_GUIDE.md** - Complete deployment instructions
- **PROJECT_SUMMARY.md** - Full project overview
- **README.md** - Main documentation

---

## 🎯 Next Steps After Login

1. **Explore Dashboard** - View analytics and metrics
2. **Test CRM Module** - Add contacts, leads, deals
3. **Test ERP Module** - Manage inventory, invoices
4. **Check Permissions** - Verify role-based access
5. **Customize Settings** - Configure your workspace

---

## 💡 Pro Tips

1. **Try Different Roles**: Login with different users to see permission levels
2. **Test Workflows**: Create sample data in CRM/ERP modules
3. **Check Reports**: View generated reports and analytics
4. **Mobile Testing**: Test on mobile devices
5. **API Testing**: Test API endpoints if configured

---

**Created**: October 8, 2025
**Updated**: October 8, 2025
**Status**: Ready for Testing

---

## 📞 Support

For questions or issues:
- Check documentation in project directory
- Review Laravel Breeze docs: https://laravel.com/docs/breeze
- Check Spatie Permissions docs: https://spatie.be/docs/laravel-permission

---

**🎉 Happy Testing!**

Use these demo credentials to explore the full functionality of the AstraCare Portal SaaS platform!
