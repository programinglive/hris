# HRIS SaaS Open Source Project

A comprehensive Human Resource Information System (HRIS) built with Laravel, Inertia.js, React, and TypeScript. This open-source project helps businesses streamline their HR operations, and while it is used by BeautyWorld, it is available for anyone to use and contribute to.

## Live demo

A public instance runs so you can try the application without installing anything:

| | |
|---|---|
| URL | https://hris.programinglive.com |
| Email | `admin@beautyhris.com` |
| Password | `password` |

Both seeded accounts (`admin@beautyhris.com` and `test@example.com`) use the password `password` and hold the `administrator` role.

> **This instance is a demo.** It is wiped and reseeded periodically, and the credentials above are intentionally public so anyone can explore the app. Do not enter real personal data. If you deploy your own copy, change the passwords.

## About HRIS Project

HRIS Project is a modern human resource management system designed to help businesses streamline their HR operations. The platform provides tools for managing employees, company structure, attendance, and more, all within a user-friendly interface.

### Key Features

- **Organization Management**
  - Create and manage companies, branches, departments, divisions, sub-divisions, positions, and position levels
  - Import branch data using templates
  - Manage multiple brands
  - Organize company structure hierarchically
  - Company registration for new tenants

- **Employee Management**
  - Comprehensive employee database with detailed records
  - Import employee data in bulk from Excel/CSV
  - View and manage employee users
  - Support for multiple roles per user
  - Associate employees with multiple brands
  - Assign work schedules and work shifts

- **User Management**
  - Role-based access control
  - Multiple roles per user
  - Multiple brands per user
  - Multiple work schedules per user
  - One work shift per day

- **Modern Interface**
  - Built with React and Inertia.js
  - Responsive design for desktop and mobile
  - Intuitive navigation

## Tech stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.3+ |
| Frontend | React 19, TypeScript, Inertia.js, Vite, Tailwind CSS |
| Database | SQLite (development), PostgreSQL or MySQL (production) |
| Queue & scheduler | Laravel queue (database driver) + `schedule:run` cron |

## Installation

### Prerequisites

- PHP 8.3 or higher, with the usual Laravel extensions
- Composer 2
- Node.js 20+ and npm
- SQLite for development, or MySQL/PostgreSQL for production

### Setup

1. **Clone the repository**

```bash
git clone https://github.com/programinglive/hris.git
cd hris
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install JavaScript dependencies**

The lockfile carries a React 19 / `@tinymce/tinymce-react@6` peer conflict, so `npm ci` needs the flag:

```bash
npm ci --legacy-peer-deps
```

4. **Environment**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure the database**

Development (SQLite) — `database/database.sqlite` must exist:

```env
DB_CONNECTION=sqlite
```

Production (PostgreSQL example):

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pghris_db
DB_USERNAME=pghris_user
DB_PASSWORD=secret
```

For production also set:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

6. **Schema and demo data**

```bash
php artisan migrate
php artisan db:seed        # optional: creates the demo accounts below
```

Seeding creates `admin@beautyhris.com` and `test@example.com`, password `password`, role `administrator`, plus 8 sample companies and the base organization structure (branches, departments, divisions, positions, levels, roles, working calendars).

7. **Build the frontend**

```bash
npm run build
```

8. **Run it**

```bash
php artisan serve    # http://localhost:8000
npm run dev          # only when editing frontend assets
```

## Production notes

Full instructions live in [docs/deployment.md](docs/deployment.md). Two things catch people out:

- **Queue worker.** With `QUEUE_CONNECTION=database`, nothing happens without a worker. Run `php artisan queue:work` under supervisor or systemd; a sample config is in `deploy/supervisor/hris-worker.conf`.
- **Nginx behind a TLS-terminating proxy.** If your load balancer ends TLS and forwards over HTTP, the vhost must pass the original scheme to PHP:

  ```nginx
  fastcgi_param HTTPS $http_x_forwarded_proto;
  ```

  Without it Laravel emits `http://` asset URLs, the browser blocks them as mixed content, and the page renders **blank with no visible error**. A ready vhost is in `deploy/nginx/hris.programinglive.com.conf`.

Schema history and the one irreversible step (a column rename) are documented in [docs/migration-notes.md](docs/migration-notes.md).

## Company Registration

Company registration is the multi-tenant entry point: it lets a new company sign up on an existing instance, create its own administrator, and keep its data separate from other tenants.

- `GET /register/company` renders the registration form
- `POST /register/company` creates the company, its administrator, and the first `user_details` row in one transaction

Note that the older multi-step wizard (`validate-contact`, `verify-code`, `save-company-details`) has been removed. Only the single-step form exists in the current code; the tests that covered the wizard are skipped with that reason.

## Landing page and registration form

- `GET /` renders the landing page
- `GET /installation-wizard` renders the first-run setup page
- `GET /register-company` renders the standalone registration page

## Testing

```bash
php artisan test
```

The suite covers feature and unit tests for employees, organization structure, attendance, and imports.

- `tests/Concerns/SkipsViteWhenUnbuilt` keeps the suite meaningful on a fresh clone: the compiled frontend lives in `public/build`, which is git-ignored, so without it every Inertia response throws "Vite manifest not found". When the manifest is missing the trait swaps in Laravel's null Vite handler; once `npm run build` has run, the real instance is used.
- A handful of tests are skipped deliberately, each with a reason in the test itself (mostly endpoints that no longer exist).

## Contributing

Issues and pull requests are welcome. Please run `php artisan test` before opening a PR.

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
