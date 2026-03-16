# OneStore

OneStore is a small custom PHP MVC e-commerce app with a storefront, cart, checkout flow, and admin panel.

This project does not use Composer for bootstrapping. The current setup flow is:

1. Configure `.env`
2. Run migrations
3. Seed sample data
4. Start the app

## Requirements

- PHP 8.1 or higher
- MySQL or MariaDB
- A web server such as Laragon, Apache, or the built-in PHP server

## Project Layout

```text
php-test/
|- app/
|  |- Controllers/
|  |- Helpers/
|  |- Models/
|  `- Views/
|- config/
|- database/
|  |- migrations/
|  |- seeders/
|  |- migrate.php
|  `- seed.php
|- public/
|  |- assets/
|  `- index.php
|- .env.example
|- index.php
`- README.md
```

## Environment Setup

Copy the example environment file:

```powershell
Copy-Item .env.example .env
```

Then update `.env` for your local setup.

Minimum values to check:

```env
APP_ENV=development
APP_DEBUG=true

APP_URL=http://localhost:8000
BASE_PATH=

DB_HOST=localhost
DB_NAME=onestore_db
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

### APP_URL and BASE_PATH

Use values that match how you serve the project:

- Laragon at `http://localhost/php-test`

```env
APP_URL=http://localhost/php-test
BASE_PATH=/php-test
```

- Laragon virtual host at `http://php-test.test`

```env
APP_URL=http://php-test.test
BASE_PATH=
```

- PHP built-in server at `http://localhost:8000`

```env
APP_URL=http://localhost:8000
BASE_PATH=
```

## Database Migrations

The migration runner creates the database automatically if it does not exist.

Run all pending migrations:

```powershell
php database/migrate.php
```

Reset everything and rebuild the schema from scratch:

```powershell
php database/migrate.php fresh
```

Rollback the most recent migration batch:

```powershell
php database/migrate.php rollback
```

Current migrations create these tables:

- `tbl_admin`
- `tbl_brand`
- `tbl_category`
- `tbl_product`
- `tbl_customer`
- `tbl_order`
- `tbl_order_item`
- `tbl_slider`
- `tbl_cart`

## Seed Sample Data

Run all seeders:

```powershell
php database/seed.php
```

Run a single seeder:

```powershell
php database/seed.php Admin
php database/seed.php Brand
php database/seed.php Category
php database/seed.php Customer
php database/seed.php Product
```

Available seeders:

- `AdminSeeder`
- `BrandSeeder`
- `CategorySeeder`
- `CustomerSeeder`
- `ProductSeeder`

Recommended first-time setup:

```powershell
php database/migrate.php fresh
php database/seed.php
```

## Run the Project

### Option 1: Laragon

1. Put the project in `C:\laragon\www\php-test`
2. Start Apache and MySQL in Laragon
3. Set `.env` to match your URL
4. Open one of these URLs:
   - `http://localhost/php-test`
   - `http://php-test.test`

### Option 2: PHP Built-in Server

From the project root, run:

```powershell
php -S localhost:8000 -t public
```

Then open:

```text
http://localhost:8000
```

## Default Seeded Accounts

Admin accounts:

- Username: `admin`
- Password: `admin123`

- Username: `manager`
- Password: `admin123`

Sample customer accounts:

- Email: `test@example.com`
- Password: `password123`

- Email: `john.doe@example.com`
- Password: `password123`

## Admin Panel

Admin URL:

```text
/admin
```

Examples:

- `http://localhost/php-test/admin`
- `http://php-test.test/admin`
- `http://localhost:8000/admin`

## Notes

- Use the migration and seeder scripts as the source of truth instead of the older SQL dump files.
- Uploaded files are stored under `public/uploads/`.
- Static assets are served from `public/assets/`.
- If routes or assets look broken, double-check `APP_URL` and `BASE_PATH` in `.env`.
