# Implementation Plan - Upgrade to Laravel 13.x

## Project Overview
Upgrade the Academic Report System from Laravel 12.x (`laravel/framework: ^12.0`) to Laravel 13.x (`laravel/framework: ^13.0`) in accordance with the official [Laravel 13.x Upgrade Guide](https://laravel.com/framework/docs/13.x/upgrade).

---

## Environment & PHP Version Requirements
- **Laravel 13 Minimum Requirement**: `PHP >= 8.3`
- **Detected Local PHP Installations**:
  - `C:\Program Files\php-8.2.0\php.exe` (currently default in PATH)
  - `C:\Program Files\php-8.4.21\php.exe` (Installed with all required modules: `pdo_pgsql`, `pgsql`, `mbstring`, `gd`, `openssl`, `curl`, `zip`)
- **Action**: Use PHP 8.4 (`C:\Program Files\php-8.4.21\php.exe`) for composer and artisan executions, and update the PHP constraint in `composer.json` to `"php": "^8.3"`.

---

## Dependency Analysis
The following packages in `composer.json` need version updates to support Laravel 13:

| Package | Current Version | Target Version | Reason / Impact |
|---|---|---|---|
| `php` | `^8.2` | `^8.3` | Laravel 13 requires PHP 8.3 or higher |
| `laravel/framework` | `^12.0` | `^13.0` | Core Laravel 13 upgrade |
| `laravel/tinker` | `^2.10.1` | `^3.0` | Laravel 13 support (`illuminate/support ^13`) |
| `pestphp/pest` | `^3.0` | `^4.0` | Pest 4 required for Laravel 13 / PHPUnit 12 |
| `pestphp/pest-plugin-laravel` | `^3.0` | `^4.0` | Required for Pest 4 + Laravel 13 compatibility |
| `nunomaduro/collision` | `^8.6` | `^8.9` | Supports Laravel 13 (`< 14.0.0`) |
| `barryvdh/laravel-dompdf` | `^3.1` (3.1.2) | `^3.1` | Already supports `illuminate/support ^13` |
| `barryvdh/laravel-snappy` | `^1.0` (1.0.5) | `^1.0` | Already supports `illuminate/support ^13` |

---

## Key Logic Flow & Compatibility Checks
1. **CSRF Protection**: Laravel 13 introduces `PreventRequestForgery` (aliased from `VerifyCsrfToken`). Checked codebase: no custom references or exclusions exist.
2. **Cache Configuration**: Laravel 13 introduces `serializable_classes => false` to harden against object deserialization. We will add `'serializable_classes' => false` to `config/cache.php`.
3. **Session Serialization**: Add `'serialization' => env('SESSION_SERIALIZATION', 'php')` in `config/session.php` to prevent session invalidation during migration.
4. **Database Queries**: Application uses PostgreSQL (`pgsql`) and does not use MySQL-specific `upsert` or `DELETE ... JOIN` queries.
5. **Polyfill / Arr Helpers**: Codebase already uses standard Laravel helpers and Eloquent collections.

---

## File Structure Changes
- `composer.json`: Update PHP and package version constraints.
- `config/cache.php`: Add `'serializable_classes' => false`.
- `config/session.php`: Add `'serialization' => env('SESSION_SERIALIZATION', 'php')`.
- `composer.lock`: Regenerated via `composer update`.

---

## Atomic Task Breakdown

### Task 1: Update Dependency Constraints in `composer.json` & Config Files
- In `composer.json`:
  - Update `"php": "^8.3"`
  - Update `"laravel/framework": "^13.0"`
  - Update `"laravel/tinker": "^3.0"`
  - Update dev `"pestphp/pest": "^4.0"`
  - Update dev `"pestphp/pest-plugin-laravel": "^4.0"`
  - Update dev `"nunomaduro/collision": "^8.9"`
- In `config/cache.php`: Add `'serializable_classes' => false`
- In `config/session.php`: Add `'serialization' => env('SESSION_SERIALIZATION', 'php')`

### Task 2: Execute Dependency Installation via PHP 8.4
- Run Composer with PHP 8.4 (`C:\Program Files\php-8.4.21\php.exe`):
  `& "C:\Program Files\php-8.4.21\php.exe" "C:\ProgramData\ComposerSetup\bin\composer.phar" update -W`
- Verify composer completes with clean resolution.

### Task 3: Configuration & Cache Verification
- Run `& "C:\Program Files\php-8.4.21\php.exe" artisan config:clear; & "C:\Program Files\php-8.4.21\php.exe" artisan route:clear; & "C:\Program Files\php-8.4.21\php.exe" artisan view:clear`
- Run `& "C:\Program Files\php-8.4.21\php.exe" artisan package:discover --ansi`

### Task 4: Run Tests & Verification
- Verify framework version with `& "C:\Program Files\php-8.4.21\php.exe" artisan --version` (confirming Laravel 13.x).
- Run test suite with `& "C:\Program Files\php-8.4.21\php.exe" artisan test`.
