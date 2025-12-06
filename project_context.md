# DanaKarya Project - Development Context

## 📋 Project Overview

**Project Name:** DanaKarya  
**Type:** Crowdfunding Platform for Indonesian UMKM (Small & Medium Enterprises)  
**Framework:** Laravel 12  
**CSS:** Tailwind CSS 3.x  
**Database:** MySQL (via XAMPP)  
**Location:** `/Users/budiman/DanakaryaProject/danakarya`  
**Repository:** https://github.com/Budiman002/danakarya  
**Branch:** main

---

## 🎯 Project Requirements

-   Laravel 12 (no Livewire, no Filament)
-   4 CRUD features + 1 Transaction feature
-   Authentication & Authorization
-   Multi-language (Indonesian & English)
-   Responsive design (Tailwind CSS)
-   Role-based system (Admin, Creator, Backer)

---

## ✅ Completed Checkpoints

### Checkpoint 0: Project Setup ✅ DONE

**Duration:** ~1.5 hours  
**Completed:** December 3, 2025

**What was done:**

-   ✅ GitHub repository created (private)
-   ✅ Laravel 12 installed (v12.40.2)
-   ✅ Database configured (MySQL via XAMPP, database: `danakarya`)
-   ✅ Tailwind CSS installed and configured
-   ✅ Project folder structure created
-   ✅ Initial commit pushed to GitHub

**Key Files Created:**

-   `tailwind.config.js` - Tailwind configuration
-   `postcss.config.js` - PostCSS configuration
-   `.env` - Database configuration
-   Folder structure in `resources/views/`:
    -   `layouts/` - Master layouts
    -   `auth/` - Authentication pages
    -   `public/` - Public pages
    -   `backer/` - Backer dashboard
    -   `creator/` - Creator dashboard
    -   `admin/` - Admin dashboard

---

### Checkpoint 1: Database Design & Migration ✅ DONE

**Duration:** ~2 hours  
**Completed:** December 3, 2025

**Database Schema (8 tables):**

1. **users** (modified Laravel default)

    - Fields: id, name, email, password, role (admin/creator/backer), avatar, bio, phone, address
    - Role enum: admin, creator, backer

2. **categories**

    - Fields: id, name, slug (unique), description, icon, status (active/inactive)
    - Auto-generates slug from name

3. **campaigns**

    - Fields: id, user_id (FK), category_id (FK), title, slug (unique), description, target_amount, current_amount, deadline, image, video_url, status (draft/pending/active/funded/completed/cancelled)
    - Auto-generates slug from title

4. **donations** (TRANSAKSI UTAMA)

    - Fields: id, user_id (FK), campaign_id (FK), amount, payment_method (transfer_bank/e_wallet), payment_proof, status (pending/confirmed/failed), transaction_code (unique), message
    - Auto-generates transaction_code: 'DN' + timestamp + random 4 digits

5. **campaign_updates** (CRUD #3)

    - Fields: id, campaign_id (FK), title, content, image

6. **campaign_faqs** (CRUD #4)

    - Fields: id, campaign_id (FK), question, answer, order

7. **disbursements**

    - Fields: id, campaign_id (FK), amount, bank_name, account_number, account_holder, status (requested/processing/disbursed/rejected), processed_at, notes

8. **password_reset_tokens** & **sessions** (Laravel default)

**Eloquent Models Created (7 models):**

-   `User.php` - with helper methods: isAdmin(), isCreator(), isBacker()
-   `Category.php` - with auto-slug generation
-   `Campaign.php` - with auto-slug generation
-   `Donation.php` - with auto-transaction-code generation
-   `CampaignUpdate.php`
-   `CampaignFaq.php`
-   `Disbursement.php`

**Seeders Created (3 seeders):**

-   `CategorySeeder.php` - 6 categories (Seni & Budaya, UMKM, Teknologi, Pendidikan, Kesehatan, Lingkungan)
-   `UserSeeder.php` - 6 users (1 admin, 2 creators, 3 backers)
-   `CampaignSeeder.php` - 4 campaigns with different statuses

**Sample Data:**

-   Admin: admin@danakarya.com / password
-   Creator 1: siti@example.com / password (Ibu Siti - Warung Makan)
-   Creator 2: budi@example.com / password (Budi Santoso - Pengrajin Batik)
-   Backer 1: ahmad@example.com / password
-   Backer 2: rina@example.com / password
-   Backer 3: dimas@example.com / password

---

### Checkpoint 2: Authentication System 🔄 90% DONE

**Duration:** ~4 hours (in progress)  
**Started:** December 3, 2025

**What was completed:**

1. **Auth Layouts:**

    - `layouts/auth.blade.php` - Split screen layout for login/register pages (with Alpine.js dropdown)
    - `layouts/profile.blade.php` - Dashboard layout with sidebar for profile pages

2. **Authentication Pages:**

    - ✅ `auth/register.blade.php` - Registration with role selection (Backer/Creator)
    - ✅ `auth/login.blade.php` - Login with remember me
    - ✅ `auth/forgot-password.blade.php` - Password reset placeholder
    - ✅ `auth/profile.blade.php` - User profile edit (name, email, phone, address, bio)
    - ✅ `auth/settings.blade.php` - Change password

3. **Profile Section Pages:**

    - ✅ `profile/notifications.blade.php` - Placeholder with layout
    - ✅ `profile/donation-history.blade.php` - Placeholder with layout

4. **Controller:**

    - `AuthController.php` with methods:
        - showRegisterForm(), register()
        - showLoginForm(), login()
        - logout()
        - showProfile(), updateProfile()
        - showSettings(), changePassword()

5. **Routes (web.php):**

    - Guest routes: register, login, forgot-password
    - Auth routes: logout, profile, settings, notifications, donation-history

6. **Features Tested:**
    - ✅ User registration (with role selection)
    - ✅ User login (with remember me)
    - ✅ Profile update (name, email, phone, address, bio)
    - ✅ Password change
    - ✅ Logout

**Assets Added:**

-   `public/images/LogoDanaKarya.png` - Logo
-   `public/images/AuthBackground.png` - Auth pages background image

**Dependencies:**

-   Alpine.js (via CDN) - For dropdown interactions

---

## 🔄 Current Task

**Task:** Add user profile dropdown to `layouts/profile.blade.php` navbar

**Status:** Already implemented in `layouts/auth.blade.php`, needs to be replicated to profile layout

**Dropdown should have:**

-   User avatar (circle with initial)
-   User name
-   Dropdown menu:
    -   My Profile (link to /profile)
    -   Settings (link to /settings)
    -   Logout (form POST to /logout)

**Location to update:** `resources/views/layouts/profile.blade.php` - navbar section

---

## 🚀 Next Steps

1. **Complete Checkpoint 2:**

    - ✅ Add user dropdown to profile layout navbar
    - ✅ Test all functionality
    - ✅ Commit to GitHub: "Checkpoint 2 completed: Authentication system with profile pages"

2. **Checkpoint 3: Authorization & Middleware** (Not started)
    - Create IsAdmin, IsCreator, IsBacker middleware
    - Apply to routes
    - 403 Forbidden page

---

## 🗂️ File Structure

```
danakarya/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Auth/
│   │           └── AuthController.php ✅
│   └── Models/
│       ├── User.php ✅
│       ├── Category.php ✅
│       ├── Campaign.php ✅
│       ├── Donation.php ✅
│       ├── CampaignUpdate.php ✅
│       ├── CampaignFaq.php ✅
│       └── Disbursement.php ✅
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php ✅
│   │   ├── xxxx_create_categories_table.php ✅
│   │   ├── xxxx_create_campaigns_table.php ✅
│   │   ├── xxxx_create_donations_table.php ✅
│   │   ├── xxxx_create_campaign_updates_table.php ✅
│   │   ├── xxxx_create_campaign_faqs_table.php ✅
│   │   ├── xxxx_create_disbursements_table.php ✅
│   │   └── xxxx_add_address_to_users_table.php ✅
│   └── seeders/
│       ├── CategorySeeder.php ✅
│       ├── UserSeeder.php ✅
│       ├── CampaignSeeder.php ✅
│       └── DatabaseSeeder.php ✅
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── auth.blade.php ✅ (with user dropdown)
│       │   └── profile.blade.php ✅ (needs user dropdown)
│       ├── auth/
│       │   ├── register.blade.php ✅
│       │   ├── login.blade.php ✅
│       │   ├── forgot-password.blade.php ✅
│       │   ├── profile.blade.php ✅
│       │   └── settings.blade.php ✅
│       └── profile/
│           ├── notifications.blade.php ✅
│           └── donation-history.blade.php ✅
├── routes/
│   └── web.php ✅
└── public/
    └── images/
        ├── LogoDanaKarya.png ✅
        └── AuthBackground.png ✅
```

---

## 🎨 Design Notes

**Color Scheme:**

-   Primary: `#7DD3C0` (Teal/Turquoise)
-   Secondary: `#5AB9A0` (Darker Teal)
-   Background: `#B8E6D5` (Light Teal)
-   Accent: `#2D7A67` (Dark Teal for links)

**Design Assets:**

-   Logo: 14px height (h-14)
-   User avatar: Circular with initial letter
-   Buttons: rounded-full for primary actions, rounded-lg for secondary
-   Cards: rounded-2xl with shadow-lg

**Responsive:**

-   Mobile menu button visible on small screens
-   Desktop navigation hidden on mobile (md:hidden / md:flex)

---

## 🔧 Technical Notes

**Authentication:**

-   Using Laravel's built-in Auth facade
-   Passwords hashed with bcrypt
-   Remember me functionality enabled
-   Session-based authentication

**Validation:**

-   Password minimum 8 characters
-   Email unique validation
-   Phone & address optional (nullable)

**Middleware:**

-   `guest` middleware for login/register pages
-   `auth` middleware for protected routes

**Frontend:**

-   Alpine.js for dropdown interactions (loaded via CDN)
-   Tailwind CSS utility classes
-   No custom JavaScript (except Alpine)

---

## 🐛 Known Issues & Fixes Applied

1. **Issue:** PostCSS plugin error when running `npm run dev`

    - **Fix:** Installed `@tailwindcss/postcss` package

2. **Issue:** Circular reference in layouts causing memory exhaustion

    - **Fix:** Ensured layout files don't extend themselves

3. **Issue:** Address field not saving in profile update

    - **Fix:** Added 'address' to validation in AuthController::updateProfile()

4. **Issue:** User stuck on dashboard after login
    - **Fix:** Profile route middleware properly configured

---

## 📝 Commands Reference

**Development:**

```bash
# Start Laravel server
php artisan serve

# Start Vite dev server
npm run dev

# Clear view cache
php artisan view:clear

# Run migrations
php artisan migrate

# Run migrations with seeders
php artisan migrate:fresh --seed
```

**Testing:**

```bash
# Test user credentials
# Admin: admin@danakarya.com / password
# Creator: siti@example.com / password
# Backer: ahmad@example.com / password

# After password change test:
# Backer: budi.testing@example.com / password000
```

---

## 📊 Progress Summary

**Overall Progress:** 2 / 31 checkpoints (6.5%)  
**Time Invested:** ~7.5 hours  
**Estimated Remaining:** ~70-100 hours

**Status:**

-   ✅ Foundation ready (setup, database, auth)
-   🔄 Moving to core features (CRUD, transactions)
-   ⏳ UI/UX implementation pending Figma designs

---

## 🎯 Immediate Next Action

**Current blocker:** None  
**Ready to:** Complete user dropdown in profile layout navbar  
**After that:** Commit Checkpoint 2 and move to Checkpoint 3

---

_Last Updated: December 3, 2025_  
_Developer: Budi (5th semester CS Binus, ASAH Dicoding-Accenture program)_

```

---

**Save this file as `PROJECT_CONTEXT.md` in your project root!**

Then tell Claude Code:
```

Please read PROJECT_CONTEXT.md in the project root for full context, then help me complete the current task.
