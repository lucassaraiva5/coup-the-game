# PHP Project Setup Guide

## Requirements
- XAMPP with PHP 8.2
- Composer
- Git

## Installation Steps

1. Clone the repository:
```bash
git clone <repository-url>
cd projeto-coup-ap2
```

2. Install dependencies:
```bash
composer install
```

3. Configure environment:
```bash
# Copy the environment template
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. Database setup:
```bash
# Configure your database settings in .env file
# For MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

# Or for SQLite:
DB_CONNECTION=sqlite
# Create an empty database.sqlite file in database directory
touch database/database.sqlite
```

5. Run migrations:
```bash
php artisan migrate
```

## XAMPP Configuration

1. Start Apache and MySQL in XAMPP Control Panel
2. Make sure your project is in `C:/xampp/htdocs/`
3. Access through: `http://localhost/projeto-coup-ap2`

## Development

- Server: `php artisan serve`
- Migrations: `php artisan migrate:fresh`
- Seeds (if any): `php artisan db:seed`

## Note
Make sure XAMPP is running with PHP 8.2 and all required extensions are enabled in `php.ini`.# coup-the-game
