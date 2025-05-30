
# Online Charity Donation Platform

[![PHP Version Support](https://img.shields.io/badge/php-%5E8.2-blue.svg)](https://www.php.net/)
[![Laravel Version Support](https://img.shields.io/badge/laravel-%5E12.x-FF2D20.svg)](https://laravel.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A web application built with Laravel 12 to facilitate secure and transparent online donations to various campaigns. This platform connects donors with causes, allowing administrators to manage campaigns and track contributions.

---

## Table of Contents

1.  [Project Overview](#1-project-overview)
2.  [Key Features](#2-key-features)
3.  [Technology Stack](#3-technology-stack)
4.  [Prerequisites](#4-prerequisites)
5.  [Installation](#5-installation)
6.  [Usage](#6-usage)
7.  [Key Functionalities Implemented](#7-key-functionalities-implemented)
8.  [Future Enhancements (Potential)](#8-future-enhancements-potential)
9.  [Contributing](#9-contributing)
10. [License](#10-license)
11. [Contact](#11-contact)

---

## 1. Project Overview

This Online Charity Donation Platform is designed to address common challenges in charitable giving, such as lack of transparency and inefficient fund management. It provides a secure and user-friendly interface for donors to discover and support various campaigns, and for administrators to manage these campaigns, post updates, and oversee donations. The platform aims to build trust and make the process of giving and receiving donations more efficient and transparent.

---

## 2. Key Features

- **User Roles:** Admin and Donor.
- **Admin Panel:**
  - Dashboard with key statistics and charts.
  - Full CRUD for Campaigns with sorting/filtering.
  - Campaign update posting.
  - Donation logs with filters and search.
- **Public Campaign Listing:**
  - Landing page with mission, featured campaigns, testimonials.
  - All campaigns page with advanced sorting.
  - Campaign detail view with progress, updates, social sharing.
- **Donation Process:**
  - Stripe Checkout integration.
  - Donor name privacy options.
- **Donor Features:**
  - Profile management.
  - Donation history.
- **Other:**
  - Tailwind-based responsive design.
  - Dark mode.
  - Sticky footer.
  - Static pages: Terms & Privacy.

---

## 3. Technology Stack

- **Backend:** PHP 8.2, Laravel 12.x
- **Frontend:** Blade, Tailwind CSS, Alpine.js, Chart.js
- **Database:** MySQL or PostgreSQL
- **Payment:** Stripe Checkout
- **Dev Tools:** Composer, NPM, Git, WAMP/XAMPP/Laragon

---

## 4. Prerequisites

Make sure you have:

- PHP >= 8.2 with required extensions
- Composer
- Node.js & NPM
- A web & database server
- Git
- Stripe test keys

---

## 5. Installation

### Cloning the Repository

```bash
git clone https://github.com/azfarazam122/Online-Charity-Donation-Platform.git
cd Online-Charity-Donation-Platform
```

### Environment Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Update your `.env` file:

```dotenv
APP_NAME="Online Charity Platform"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charity_platform_db
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=pk_test_YOUR_STRIPE_PUBLISHABLE_KEY
STRIPE_SECRET=sk_test_YOUR_STRIPE_SECRET_KEY
```

Create `charity_platform_db` in phpMyAdmin with `utf8mb4_unicode_ci`.

### Database Migration

```bash
php artisan migrate
```

### Storage Link

```bash
php artisan storage:link
```

### Frontend Assets

```bash
npm install
npm run dev
```

### Running the Application

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 6. Usage

### Admin User

1. Register via `/register`.
2. Change `role` column in `users` table to `admin`.
3. Log in to access `/admin/dashboard`.

### Donor User

1. Register via `/register`.
2. Log in to access `/my-donations`.
3. Browse and donate to campaigns.

---

## 7. Key Functionalities Implemented

- **Authentication:** Laravel Breeze (register, login, password reset).
- **Roles:** Admin vs Donor access.
- **Admin Dashboard:**
  - Stats & donation chart.
  - Latest donations list.
- **Campaigns Management:** CRUD, images, sorting, filters, updates.
- **Donations Management:** Paginated, searchable donations.
- **Public Pages:**
  - Landing page with mission, featured campaigns, etc.
  - All Campaigns list with sorting.
  - Campaign detail view with updates and donor list.
- **Donation System:**
  - Stripe Checkout.
  - Custom amount.
  - Public/anonymous donor names.
- **Donor Area:**
  - Profile updates.
  - Donation history.
- **Static Pages:**
  - Terms & Privacy.
- **UI Features:**
  - Responsive layout.
  - Dark mode.
  - Sticky footer.

---

## 8. Future Enhancements (Potential)

- Stripe webhooks for payment confirmation.
- Campaign categories.
- Editable/deletable campaign updates.
- Email notifications.
- Admin reporting with data export.
- PDF donation receipts.
- More donor profile fields.
- Advanced search/filter.
- Testing suite (unit/feature tests).
- SEO optimization.
- Performance & caching strategies.

---

## 9. Contributing

1. Fork the repo
2. Create a feature branch:
   ```bash
   git checkout -b feature/YourAmazingFeature
   ```
3. Commit changes:
   ```bash
   git commit -m "Add YourAmazingFeature"
   ```
4. Push to your fork:
   ```bash
   git push origin feature/YourAmazingFeature
   ```
5. Open a Pull Request

Please follow PSR-12 standards and include tests if applicable.

---

## 10. License

This project is licensed under the MIT License. See the [LICENSE.md](LICENSE.md) file for details.

---

## 11. Contact

**Azfar Azam** – azfarazam@gmail.com  
Project Link: [https://github.com/azfarazam122/Online-Charity-Donation-Platform](https://github.com/azfarazam122/Online-Charity-Donation-Platform)
