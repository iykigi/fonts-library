<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/yourusername/fontstore/actions">
    <img src="https://img.shields.io/github/actions/workflow/status/yourusername/fontstore/tests.yml?branch=main" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/badge/Laravel-11.x-red" alt="Laravel Version">
  </a>
  <a href="https://github.com/yourusername/fontstore/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/yourusername/fontstore" alt="License">
  </a>
</p>

<h1 align="center">🅵 فۆنت‌ستۆر – پلاتفۆرمی بەڕێوەبردنی فۆنت و پۆست</h1>

<p align="center">
  <b>فۆنت‌ستۆر</b> پلاتفۆرمێکی تەواوە بۆ بەڕێوەبردنی فۆنت و پۆست، بە دوو بەشی سەرەکی: <b>باک‌ئێند</b> و <b>فرۆند‌ئێند</b>.  
  ئەم پڕۆژەیە بە <b>Laravel 11</b> دروست کراوە و دوو داشبۆردی جیاوازی تێدایە:  
  <b>داشبۆردی پۆست و فۆنت</b> بۆ بەڕێوەبەران، و  
  <b>داشبۆردی ئەدمین</b> بۆ ڕێکخستنی ڕۆڵ و چاڵاکییەکانی بەکارهێنەران.
</p>

---

## ✨ تایبەتمەندییە سەرەکییەکان

- **🔍 دیزاینی UI سێرچ (Search UI)** بۆ ئاسانکاری لە دۆزینەوەی فۆنت و پۆست.
- **🖼 ئایکۆنەکانی Heroicons** بەکارهاتووە بۆ ڕوونتربوونەوەی ناوەرۆک.
- **⚡ دوو داشبۆردی جیاواز** بەپێی ئاستی دەستڕاگەیشتن.
- **📝 بەڕێوەبردنی فۆنت و پۆست** لەلایەن ئەندامانی تیم.
- **👤 سیستەمی ڕۆڵ و دەستڕاگەیشتن** (بە Spatie Permission).
- **📦 ڕەشکردنەوەی تەواو (Dark Mode)** بۆ ئاسوودەیی بینین.
- **🧩 کۆدێکی پاک و خوێنەراوە** بەپێی ستانداردەکانی PSR‑12.

---

## 🧩 پێکهاتەکانی پڕۆژە

### ۱. 🗂 **باک‌ئێند (Backend)**
- **Laravel 11** بە ستراکچەری ماژوڵاری.
- **RESTful API** بۆ پەیوەندی لەگەڵ فرۆند‌ئێند.
- **Middleware** بۆ ڕێگری لە دەستڕاگەیشتنی ڕێگەپێنەدراو.
- **Database Migrations & Seeders** بۆ دابینکردنی داتای سەرەتایی.

### ۲. 🎨 **فرۆند‌ئێند (Frontend)**
- **Blade + Tailwind CSS** بۆ دیزاینی سادە و خێرا.
- **Alpine.js** بۆ کارلێکەکانی بەکارهێنەر.
- **UI سێرچ (Search UI)** بۆ گەڕانی پێشکەوتوو لە فۆنت و پۆستدا.
- **ڕەشکردنەوە (Dark/Light Mode)** بە JavaScript.

---

## 📊 پێکهاتەی داشبۆردەکان

### 🖋 داشبۆردی پۆست و فۆنت (بۆ بەڕێوەبەران)
- زیادکردن، دەستکاری و سڕینەوەی فۆنت.
- بەڕێوەبردنی پۆستەکان (نووسین، بڵاوکردنەوە).
- پێداچوونەوە و پەسەندکردنی پۆست لەلایەن تیم.

### ⚙️ داشبۆردی ئەدمین (بۆ بەڕێوەبەری سیستەم)
- ڕێکخستنی ڕۆڵ و دەستڕاگەیشتن (بە Spatie).
- بینینی تەواوی چالاکییەکانی بەکارهێنەران.
- بەڕێوەبردنی هەموو بەشداربووان و پۆستەکان.

---

## 🚀 نصب و ڕێکخستن

```bash
# ۱. کڵۆنکردنی پرۆژە
git clone https://github.com/yourusername/fontstore.git
cd fontstore

# ۲. دامەزراندنی پاکێجەکان
composer install
npm install && npm run build

# ۳. ڕێکخستنی فایلی ژینگە
cp .env.example .env
php artisan key:generate

# ۴. دروستکردن و پڕکردنی داتابەیس
php artisan migrate --seed

# ۵. ڕێکخستنی ڕۆڵەکان
php artisan db:seed --class=RolePermissionSeeder

# ۶. خزمەتگوزاری ناوخۆیی
php artisan serve
npm run dev
