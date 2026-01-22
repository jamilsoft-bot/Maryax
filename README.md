# Maryax ERP (Jamilsoft)

Maryax is a modular, cPanel-friendly ERP system built with PHP 8.1+, TailwindCSS, and PDO. The architecture is designed to run on shared hosting with an installer wizard and optional CLI tooling.

## Features (Baseline)
- Installer wizard (`/installer`) for cPanel environments.
- Multi-tenant-ready schema (organization scoping).
- RBAC foundation (roles + permissions seeded).
- Core dashboard layout with responsive sidebar.
- CSRF protection, session hardening, password hashing.

## Requirements
- PHP 8.1+
- MySQL/MariaDB
- Composer (for dependencies)

## cPanel Deployment
1. **Upload files**
   - Upload the repository contents to your hosting account.
2. **Set web root to `/public`**
   - In cPanel, set the document root (or create a subdomain) that points to `/public`.
3. **Install dependencies**
   - Run `composer install` from the project root (via SSH or cPanel terminal).
4. **Run the installer**
   - Visit `https://your-domain.com/installer` and complete the setup form.
   - The installer writes `.env`, runs migrations, seeds roles, and creates your admin account.
5. **Optional CLI**
   - If you have SSH: `php cli.php migrate` and `php cli.php seed`.

## Environment Configuration
Create a `.env` file based on `.env.example`:
```
APP_NAME=Maryax
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_TIMEZONE=UTC
APP_SESSION=maryax_session

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password

BRAND_NAME=Jamilsoft
BRAND_TAGLINE=Technology & Business Solutions
BRAND_LOGO_URL=https://jamilsoft.com.ng/assets/images/icon.png
BRAND_FAVICON_URL=https://jamilsoft.com.ng/assets/images/icon.png
BRAND_PRIMARY_COLOR=#1d4ed8
BRAND_SECONDARY_COLOR=#0f172a
BRAND_FOOTER_TEXT=Powered by Jamilsoft Technologies
```

## Docs
- `docs/BRAND_SCAN.md` – website scan summary
- `docs/BLUEPRINT.md` – module + schema plan
- `docs/ARCHITECTURE.md` – architectural overview
- `docs/SECURITY.md` – security controls
- `docs/MODULES.md` – module status

## Notes
- This repository includes initial scaffolding. Module implementations will be expanded in future iterations.
