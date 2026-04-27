# AGENTS.md

## Commands

```bash
# Setup (first time)
composer setup

# Run dev server (concurrent: Vite, Artisan serve, queue listener, logs)
composer dev

# Run tests
composer test
# or: php artisan test
```

## Architecture

- **User routes**: `routes/web.php` (customer-facing)
- **Admin routes**: `routes/admin.php` (prefixed with `admin.` route names)
- **Controllers**: `App\Http\Controllers\User/*` and `App\Http\Controllers\Admin/*`
- **Models**: `app/Models/`
- **Views**: `resources/views/user/` and `resources/views/admin/`

## Key Notes

- Laravel 12 + TailwindCSS 4.0 + Vite
- Invoice PDFs generated via `barryvdh/laravel-dompdf`
- Two route files: web.php, admin.php
- Admin authentication separate from user auth
- **Current Theme**: Shoe/Sandal store with dark black (#111827) primary + emerald (#10b981) accent