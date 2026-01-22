# Maryax Architecture

## Structure
```
/app
  /Core
  /Modules
  /Shared
/config
/database
  /migrations
  /seeders
/docs
/public
/resources
  /views
/storage
```

## Runtime Flow
1. `public/index.php` bootstraps autoloading, environment variables, session, and routing.
2. The `Router` dispatches a request to module controllers.
3. Controllers call service logic (to be expanded) and render views through `View::render`.
4. Configuration is loaded from `config/*.php` with `.env` overrides.

## Multi-Tenant Ready
- `organization_id` appears in core tables.
- All future modules must scope data by organization.

## Installer & CLI
- `/installer` provides a web-based bootstrap that writes `.env`, runs migrations, and creates the first admin.
- `php cli.php migrate|seed` supports CLI environments.

## UI Layer
- Server-rendered PHP views.
- TailwindCSS and Font Awesome via CDN.
- A shared layout includes top nav + sidebar for consistent navigation.
