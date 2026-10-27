# ClassroomOS — Classroom Management

A Laravel CRUD app for managing student and teacher records. The UI uses Tailwind CSS 4 with Vite and includes responsive navigation, overview counts, search, gender filters, pagination, validated forms, teacher photo uploads, and delete confirmation.

## Requirements

- PHP version supported by this Laravel project, with required PHP extensions
- Composer
- Node.js and npm
- SQLite (default) or a configured MySQL database

## 1. Open the project

Extract `classroom_crud.zip`, open the `classroom_crud` folder in VS Code or your IDE, then open a terminal in that folder.

## 2. Install dependencies

```bash
composer install
npm install
```

## 3. Configure environment

Copy `.env.example` to `.env` if `.env` does not exist.

Windows Command Prompt:
```bat
copy .env.example .env
```

Git Bash / macOS / Linux:
```bash
cp .env.example .env
```

Generate the application key:
```bash
php artisan key:generate
```

### Database option A — SQLite (default)

Create an empty SQLite database file if it is missing:

Git Bash / macOS / Linux:
```bash
touch database/database.sqlite
```

Windows Command Prompt:
```bat
type nul > database\database.sqlite
```

In `.env`, make sure these values are set:
```env
DB_CONNECTION=sqlite
```

The `database/database.sqlite` file is intentionally not included in this ZIP; create it with the command above.

### Database option B — MySQL

Create a database in MySQL, for example `classroom_crud`, then set `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=classroom_crud
DB_USERNAME=root
DB_PASSWORD=
```
Use your own database username/password if they differ.

## 4. Run migrations

The student and teacher migration files define the tables and columns needed by the CRUD forms, including unique email addresses and gender values.

For a **new / empty database**, run:
```bash
php artisan migrate
```

If you already ran migrations in an older copy of this project, the original migration files have changed. Back up any records you need first. To rebuild the schema from these migration files (this **deletes all existing tables and records** in the configured database), run:
```bash
php artisan migrate:fresh
```

Do not run `migrate:fresh` if you need to keep existing records. In that case, create a new forward migration to alter your existing schema instead of editing old migration files.

## 5. Enable teacher photo storage

```bash
php artisan storage:link
```

This lets uploaded teacher photos display from `storage/app/public`.

## 6. Start the app

Open two terminals in the project folder.

Terminal 1:
```bash
npm run dev
```

Terminal 2:
```bash
php artisan serve
```

Open the URL printed by Laravel, usually `http://127.0.0.1:8000`.

For a production asset build, use `npm run build` instead of keeping `npm run dev` running.

## Features

- Overview page with live student/teacher totals
- Student CRUD: name, gender, email, phone, address
- Teacher CRUD: name, gender, email, phone, profile image
- Search by name, email, or phone
- Filter by gender and paginate results
- Server-side validation and unique email checks
- Teacher image validation and replacement/deletion cleanup
- Responsive Tailwind-based interface and delete confirmation

## Troubleshooting

- **Vite manifest not found:** run `npm install` then `npm run build`, or keep `npm run dev` running.
- **Table/column missing:** check `.env` database settings, then run `php artisan migrate`. Only use `php artisan migrate:fresh` if you accept losing the database's existing records.
- **Photos do not show:** run `php artisan storage:link`.
- **Clear cached configuration after changing `.env`:** `php artisan optimize:clear`.
