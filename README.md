# 🎓 College Master Admin Panel (Laravel Package)

A universal, plug-and-play Master Admin Panel for College Management Systems. Install into any fresh Laravel project to automatically integrate full admin backend functionality (Notices, Events, Faculty, AQAR, Users, Roles & Permissions, DataTables, Media Gallery, Multi-language support) with built-in version tracking and one-command updates.

---

## 🚀 Features

- **Zero-Friction Integration**: Auto-discovered by Laravel.
- **Complete College Modules**:
  - Notices Management
  - Events & Event Galleries
  - Faculty & Non-Faculty Directory
  - Departments & Subject Mapping
  - Banners & Sliders
  - AQAR (Sessions & Criteria)
  - Spatie-powered User Roles & Permissions Matrix
  - Profile & Password Security
- **Version Tracking & Remote Update Alerts**: Informs administrators when newer releases are available on GitHub/Packagist.
- **One-Command Setup & Updates**: `php artisan college-admin:install` & `php artisan college-admin:update`.
- **Localization**: English (`en`) and Hindi (`hi`) support.

---

## 📦 Installation in Any Laravel Project

### 1. Require Package via Composer
```bash
composer require college-admin/college-admin
```

*(For local/private package testing, add `"repositories": [{"type": "path", "url": "packages/college-admin"}]` in `composer.json`)*

### 2. Run the One-Step Installer
```bash
php artisan college-admin:install
```

This command automatically:
1. Publishes configuration (`config/college-admin.php`).
2. Publishes static assets (CSS, JS, Fonts, Images) to `public/vendor/college-admin/assets`.
3. Runs all database migrations.
4. Seeds default roles, permissions, and administrator user.
5. Clears and warms application caches.

### 3. Access Admin Panel
Visit:
```
http://your-domain.test/admin
```
**Default Credentials:**
- **Email:** `admin@gmail.com`
- **Password:** `123456`

---

## 🔄 Versioning & Update System

### Version Constants
The package version is defined in `CollegeAdmin\CollegeAdmin::VERSION` (e.g., `1.0.0`).

### In-Dashboard Update Notification
When you release a new version with a Git tag (e.g., `v1.1.0`), client installations will automatically detect the newer version via the `VersionChecker` service and display an alert banner in the dashboard.

### Applying Updates in Client Applications
To update an existing college project to the latest release:
```bash
composer update college-admin/college-admin
php artisan college-admin:update
```

The `college-admin:update` command will:
- Re-publish fresh CSS/JS/images (`--force`).
- Run any newly added database migrations.
- Clear route, view, and config caches.

---

## ⚙️ Configuration (`config/college-admin.php`)

```php
return [
    // Version number
    'version' => \CollegeAdmin\CollegeAdmin::VERSION,

    // Custom route prefix and middlewares
    'route' => [
        'prefix' => env('COLLEGE_ADMIN_PREFIX', 'admin'),
        'middleware' => ['web', 'localization'],
        'name_prefix' => 'admin.',
    ],

    // Update checker configuration
    'updates' => [
        'check_enabled' => env('COLLEGE_ADMIN_CHECK_UPDATES', true),
        'github_repo' => env('COLLEGE_ADMIN_GITHUB_REPO', 'your-org/college-master-admin'),
        'cache_duration_hours' => 12,
    ],

    // Branding
    'branding' => [
        'app_name' => env('COLLEGE_ADMIN_NAME', 'College Master Admin'),
        'logo_path' => 'vendor/college-admin/assets/img/logo.png',
    ],
];
```

---

## 🛠️ How to Publish New Releases (For Package Maintainers)

1. Bump `VERSION` in `packages/college-admin/src/CollegeAdmin.php`:
   ```php
   const VERSION = '1.1.0';
   ```
2. Commit and push:
   ```bash
   git add .
   git commit -m "Release v1.1.0 - Added new modules"
   ```
3. Tag the release:
   ```bash
   git tag v1.1.0
   git push origin v1.1.0
   ```
4. All client installations will now receive notification of the update in their admin dashboard!
