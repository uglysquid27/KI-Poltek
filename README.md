<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# KI-Poltek

KI-Poltek is a Laravel-based web application designed to manage intellectual property data such as patents and copyrights. This project leverages Laravel's powerful features, including routing, Eloquent ORM, and Blade templating.

---

## Requirements

Before you begin, ensure you have the following installed on your system:

- PHP >= 8.2
- Composer
- Node.js and npm
- MySQL or any other supported database
- Git

---

## Installation Instructions

Follow these steps to clone and set up the project:

### 1. Clone the Repository

git clone https://github.com/your-username/KI-Poltek.git
cd KI-Poltek

---

## 2. Install Dependencies

Run the following command to install PHP dependencies:
composer install

Install JavaScript dependencies:
npm install

---

## 3. Set Up Environment Variables

Copy the .env.example file to .env:
cp [.env.example](http://_vscodecontentref_/1) .env

edit the .env file to configure your database and other environment variables:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

---

## 4. Generate Application Key
Run the following command to generate the application key:
php artisan key:generate

---

## 5. Run Database Migrations
Run the migrations to set up the database schema:
php artisan migrate

(Optional) Seed the database with sample data:
php artisan db:seed

---

## 6. Build Frontend Assets
Compile the frontend assets using Laravel Mix:
npm run dev

For production:
npm run build

---
## 7. Start the Development Server
Run the following command to start the Laravel development server:
php artisan serve

The application will be available at http://127.0.0.1:8000