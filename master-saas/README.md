# AstraCare Portal - Multi-Tenant SaaS Platform

A comprehensive Laravel 11-based SaaS platform featuring CRM, ERP, and other business solutions with multi-tenancy support.

## 🚀 Features

- **Multi-Tenancy**: Complete tenant isolation with separate databases
- **Modern Stack**: Laravel 11 + Inertia.js + Vue 3 + Tailwind CSS
- **Billing**: Stripe integration via Laravel Cashier
- **Modular Architecture**: Easy to add new modules (CRM, ERP, etc.)
- **Performance**: Redis caching, queuing, and session management
- **Security**: 2FA support, role-based permissions, rate limiting
- **Scalable**: Ready for horizontal scaling with load balancing

## 📋 Tech Stack

### Backend
- **Framework**: Laravel 11
- **Multi-Tenancy**: Stancl/Tenancy
- **Authentication**: Laravel Sanctum
- **Permissions**: Spatie Laravel Permission
- **Billing**: Laravel Cashier (Stripe)
- **Queue**: Redis
- **Cache**: Redis
- **Database**: MySQL/MariaDB

### Frontend
- **Framework**: Vue 3
- **Routing**: Inertia.js
- **Build Tool**: Vite
- **Styling**: Tailwind CSS
- **Route Helper**: Ziggy

### Infrastructure
- **Web Server**: Nginx
- **PHP**: PHP 8.3 with PHP-FPM
- **Queue Worker**: Supervisor
- **Storage**: AWS S3 / DigitalOcean Spaces
- **CDN**: Cloudflare
- **CI/CD**: GitHub Actions

## 🛠️ Installation

### Prerequisites

- PHP 8.3+
- Composer 2.x
- Node.js 22.x
- MySQL/MariaDB 8.x
- Redis 7.x
- Nginx
- Supervisor

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd master-saas
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database** (edit `.env`)
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   php artisan db:seed  # Optional: Seed with demo data
   ```

7. **Build frontend assets**
   ```bash
   npm run dev  # Development
   npm run build  # Production
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

   Visit: `http://localhost:8000`

### Production Deployment

#### 1. Server Requirements

```bash
# Install PHP 8.3 extensions
sudo apt-get install php8.3-fpm php8.3-mysql php8.3-redis php8.3-bcmath php8.3-mbstring php8.3-xml php8.3-curl

# Install Redis
sudo apt-get install redis-server

# Install Supervisor
sudo apt-get install supervisor
```

#### 2. Nginx Configuration

Copy the Nginx configuration:
```bash
sudo cp deployment/nginx/master.astracareportal.com.conf /etc/nginx/sites-available/
sudo ln -s /etc/nginx/sites-available/master.astracareportal.com.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### 3. SSL Certificate (Let's Encrypt)

```bash
sudo certbot --nginx -d master.astracareportal.com
```

#### 4. Supervisor Configuration

```bash
sudo cp deployment/supervisor/laravel-worker.conf /etc/supervisor/conf.d/
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start master-saas-worker:*
```

#### 5. Environment Configuration

```bash
cp .env.production.example .env
# Edit .env with production credentials
php artisan key:generate
```

#### 6. Deploy

```bash
bash deployment/scripts/deploy.sh
```

Or use GitHub Actions for automated deployment.

## 🔧 Configuration

### Multi-Tenancy Setup

The platform uses `stancl/tenancy` for multi-tenancy. Configuration file: `config/tenancy.php`

#### Create a new tenant:
```php
$tenant = Tenant::create(['id' => 'company-slug']);
$tenant->domains()->create(['domain' => 'company.astracareportal.com']);
```

### Redis Configuration

Update `.env`:
```env
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

### Stripe/Cashier Configuration

```env
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...
CASHIER_CURRENCY=usd
```

## 📦 Modules

### CRM Module
Location: `Modules/CRM/`

Features:
- Contact management
- Lead tracking
- Deal pipeline
- Activity logging

### ERP Module
Location: `Modules/ERP/`

Features:
- Inventory management
- Purchase orders
- Invoicing
- Financial reports

### Adding New Modules

1. Create module directory:
   ```bash
   mkdir -p Modules/YourModule/src/{Models,Controllers,Services,Routes,Migrations}
   ```

2. Create service provider:
   ```php
   // Modules/YourModule/YourModuleServiceProvider.php
   namespace Modules\YourModule;

   use Illuminate\Support\ServiceProvider;

   class YourModuleServiceProvider extends ServiceProvider
   {
       public function boot()
       {
           $this->loadRoutesFrom(__DIR__ . '/src/Routes/web.php');
           $this->loadMigrationsFrom(__DIR__ . '/src/Migrations');
       }
   }
   ```

3. Register in `config/app.php`:
   ```php
   'providers' => [
       // ...
       Modules\YourModule\YourModuleServiceProvider::class,
   ],
   ```

## 🔐 Security

- All routes protected with CSRF tokens
- Rate limiting enabled (30 requests/minute)
- SQL injection protection via Eloquent ORM
- XSS protection via Vue sanitization
- Role-based access control (RBAC)
- 2FA support
- Secure session management

## 📊 Performance Optimization

- **OPcache**: Enabled for PHP
- **Redis**: Caching, sessions, queues
- **CDN**: Static assets served via Cloudflare
- **Gzip**: Compression enabled
- **Asset caching**: 1-year cache headers
- **Queue workers**: Async job processing
- **Database indexing**: Optimized queries

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# With coverage
php artisan test --coverage
```

## 📝 Commands

```bash
# Clear all caches
php artisan optimize:clear

# Optimize for production
php artisan optimize

# Run queue worker
php artisan queue:work redis

# Create tenant
php artisan tenant:create

# Run tenant migrations
php artisan tenants:migrate
```

## 🚨 Troubleshooting

### Queue not processing
```bash
php artisan queue:restart
sudo supervisorctl restart master-saas-worker:*
```

### Assets not loading
```bash
npm run build
php artisan view:clear
```

### Database connection issues
```bash
php artisan config:clear
php artisan cache:clear
```

## 📚 Documentation

- [Laravel Docs](https://laravel.com/docs)
- [Stancl Tenancy Docs](https://tenancyforlaravel.com/docs)
- [Inertia.js Docs](https://inertiajs.com)
- [Vue 3 Docs](https://vuejs.org)
- [Tailwind CSS Docs](https://tailwindcss.com)

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software for Terragon Labs.

## 🆘 Support

For support, email support@astracareportal.com

---

**Built with ❤️ by Terragon Labs**
