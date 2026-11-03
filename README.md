# MediLab: Vaccine Management System

A Laravel web application where parents book vaccines for their children and track vaccination schedules, while hospitals and admins manage vaccines, schedules and requests.

**Live demo:** https://medilab.infinityfreeapp.com/

## Overview

MediLab started as a classic Laravel app with controllers and Blade dashboards. I later migrated the whole dashboard layer to **Filament**, which gave cleaner resources, built-in tables and forms, and faster admin development. The public landing page is still a Blade site with a full SEO layer.

## Features

- Separate **Parent** panel (`/dashboard`) and **Admin** panel (`/admin`) built with Filament
- Parent registration and login
- Child profiles
- Vaccine requests and appointment management
- Vaccination schedules per hospital
- Hospital and vaccine management for admins
- Dashboard widgets and charts (appointment status, requests, schedules per month)
- SEO-ready landing page: metadata, Open Graph, Schema.org, sitemap and robots rules

## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Admin and parent panels:** Filament
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS, Vite
- **SEO:** Open Graph, Schema.org JSON-LD, sitemap.xml, robots.txt

## Requirements

- PHP 8.2 or higher with the `intl` extension
- Composer
- Node.js and npm
- MySQL

## Local Setup

```bash
git clone https://github.com/x-hamza47/vaccine-management-laravel.git
cd vaccine-management-laravel

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Set your database details in `.env`:

```dotenv
DB_DATABASE=vaccine_management_system
DB_USERNAME=root
DB_PASSWORD=
APP_URL=http://localhost:8000
```

Then run:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Open http://localhost:8000.

## Panels

| Panel  | URL                  | Purpose                                      |
| ------ | -------------------- | -------------------------------------------- |
| Admin  | `/admin`             | Manage hospitals, vaccines, schedules, users |
| Parent | `/dashboard`         | Children, vaccine requests, schedules        |

Admin credentials come from `database/seeders/AdminSeeder.php`. Change them before deploying.

## Deployment (shared hosting without SSH)

This project is deployed on InfinityFree, which has no SSH, Composer or Node. The approach:

1. Run `composer install --no-dev --optimize-autoloader` and `npm run build` locally.
2. Upload the contents of `public/` to `htdocs/`.
3. Upload the rest of the project into `htdocs/laravel/` (without `node_modules`, `.git` or `tests`).
4. In `htdocs/index.php`, point the paths to `__DIR__.'/laravel/...'` and add `$app->usePublicPath(__DIR__);` so Vite finds `build/manifest.json`.
5. Block the `laravel/` folder in `htdocs/.htaccess`.
6. Create a production `.env` with `APP_ENV=production`, `APP_DEBUG=false` and `QUEUE_CONNECTION=sync`.
7. Export the local database and import it with phpMyAdmin.

## Project Structure

```
app/
  Filament/
    Resources/      Admin resources (children, hospitals, users, schedules, requests, vaccines)
    Parent/         Parent panel pages and widgets
    Widgets/        Admin dashboard widgets
  Models/           Children, Hospital, User, VaccinationSchedule, Vaccine, VaccineRequest
  Providers/Filament/   AdminPanelProvider, ParentPanelProvider
resources/views/    Landing page sections and SEO partials
database/           Migrations, factories, seeders
```

## Author

**Hamza Aamir**
Portfolio: https://hamzaamir-portfolio.web.app/
GitHub: https://github.com/x-hamza47
LinkedIn: https://www.linkedin.com/in/hamza-aamir-dev/
