# ISET KAIROUAN FAMILY Platform 🎓

## About The Project

ISET KAIROUAN FAMILY is a comprehensive platform designed to manage and facilitate club activities, events, and communications within the ISET KAIROUAN (Higher Institute of Technological Studies Of Kairouan ) community. The platform connects students, club leaders, and administrators in a seamless digital environment.

## Features 🌟

- **Club Management**
  - Create and manage clubs
  - Track club memberships
  - Manage club roles and responsibilities
  - Generate club member reports (PDF)

- **Event Management**
  - Create and schedule events
  - Track event participants
  - Event statistics and reporting

- **User Management**
  - Role-based access control
  - Status tracking for club members

- **Communication**
  - Contact messaging system
  - Club announcements
  - Event notifications

## Tech Stack 💻

- **Backend Framework:** Laravel
- **Frontend:** 
  - Blade 
  - TailwindCSS
  - JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Breeze 
- **PDF Generation:** DomPDF

## Prerequisites 📋

Make sure you have the following installed:

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Git

## Installation 🚀

1. **Clone the repository**
   ```bash
   git clone https://github.com/houdaghalmi/isetkr-family.git
   cd iset-link
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   - Edit `.env` file with your database credentials
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Build Assets**
   ```bash
   npm run dev
   ```

8. **Start the Server**
   ```bash
   php artisan serve
   ```

## Usage 📱

1. **User Roles**
   - Admin: Full access to all features
   - Club Responsible: Manage specific club activities
   - Member: Participate in clubs and events
   - Guest: View public information

2. **Club Management**
   - Create new clubs
   - Add/remove members
   - Assign roles
   - Generate reports

3. **Event Management**
   - Schedule events
   - Track attendance
   - Manage registrations



---

Made with ❤️ for ISETKR community

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

