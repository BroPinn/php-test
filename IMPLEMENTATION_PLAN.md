# OneStore Implementation Plan: Database, Auth, Catalog & S3

**Database:** `onestore_db` (MySQL 8.0)  
**Status:** In Progress — Phase 0, Phase 1 & Phase 2 Complete

---

## Roadmap Overview

```text
[x] Phase 0: Environment & Tooling Verification
[x] Phase 1: PDO Database Connection (app/Database.php)
[x] Phase 2: Administrator Authentication & Session Guard
[ ] Phase 3: Catalog CRUD Backend (Products, Categories, Brands, Sliders)
[ ] Phase 4: S3 & CloudFront Image Storage Integration
[ ] Phase 5: Storefront Live Data & Polish
```

---

## Detailed Phases

### Phase 0 — Environment & Tooling Verification
- [x] Verify PHP runtime (`PHP 8.1.10` with PDO MySQL, OpenSSL, cURL, Fileinfo, Mbstring, SimpleXML).
- [x] Verify local Composer installation (`C:\laragon\bin\composer\composer.phar`).
- [x] Verify MySQL connection to `localhost`.
- [x] Preserve static UI templates and single entry point (`index.php`).

### Phase 1 — PDO Database Connection
- [x] Configure connection credentials in `.env` (`DB_HOST=localhost`, `DB_NAME=onestore_db`, `DB_USER=root`, `DB_PASS=`).
- [x] Create lightweight, zero-dependency `Database` singleton in `app/Database.php`.
- [x] Load `.env` variables automatically on connection.
- [x] Configure secure PDO defaults:
  - `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`
  - `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`
  - `PDO::ATTR_EMULATE_PREPARES => false`
- [x] Verify live connection to `onestore_db`.

### Phase 2 — Administrator Authentication & Session Guard
- [x] Verify `tbl_admin` table structure.
- [x] Create clean MVC folder structure (`app/Models/Admin.php`, `app/Controllers/Admin/AuthController.php`) without unnecessary code.
- [x] Implement `POST /admin/login` handling in `index.php` with `password_verify()`.
- [x] Add route protection/guard: redirect unauthenticated visits to `/admin/login`.
- [x] Implement `/admin/logout` to destroy session and redirect to login.
- [x] Display admin profile name dynamically in `header.php` and `sidebar.php`.

### Phase 3 — Catalog Backend CRUD (Products, Categories, Brands, Sliders)
- [ ] Create repository/model queries using prepared PDO statements:
  - Products: list with pagination/search, create, update, delete.
  - Categories: list, create, update, delete.
  - Brands: list, create, update, delete.
  - Sliders: list, create, update, delete.
- [ ] Wire admin table templates to render database records.
- [ ] Wire modal forms to submit POST requests and persist changes.
- [ ] Implement input validation and error feedback.

### Phase 4 — S3 & CloudFront Image Storage Integration
- [ ] Install AWS SDK for PHP using Composer (`composer require aws/aws-sdk-php`).
- [ ] Add S3 configuration to `.env`:
  ```dotenv
  AWS_REGION=your-region
  AWS_S3_BUCKET=your-bucket-name
  AWS_ACCESS_KEY_ID=your-key
  AWS_SECRET_ACCESS_KEY=your-secret
  AWS_CLOUDFRONT_URL=https://your-distribution.cloudfront.net
  ```
- [ ] Create `app/Storage.php` service:
  - Validate image format (JPEG, PNG, WebP) and size (<= 5MB).
  - Upload image file to S3 bucket prefix.
  - Generate CloudFront / public CDN URL.
- [ ] Update `upload()` helper function to seamlessly resolve CloudFront URLs for S3 images while keeping demo images local.
- [ ] Handle image replacement and S3 object deletion on product updates.

### Phase 5 — Storefront Dynamic Catalog
- [ ] Populate Homepage with active sliders and featured products from MySQL.
- [ ] Populate Shop page (`/shop`) with database catalog, category filters, and search.
- [ ] Populate Product detail page (`/product/{id}`) from database.
- [ ] Maintain fallback demo data if tables are empty.

---

## Quick Reference & Commands

- **Local Web Server:** `php -S localhost:8000`
- **Database Test:** `php app/Database.php`
- **Current Database:** `onestore_db` on `127.0.0.1:3306`
