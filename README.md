# 🎨 Fonts Library

> A modern web application for managing and showcasing font collections.  
> Built with Laravel & Vite.

---

## 📌 About The Project

**Fonts Library** پڕۆژەیەکی وێبە بۆ بەڕێوەبردن و پیشاندانی کۆمەڵە فۆنتەکان.  
ئەم پڕۆژەیە دروستکراوە بە بەکارهێنانی:

- Laravel (Backend Framework)
- Vite (Frontend Build Tool)
- MySQL (Database)
- Blade / Modern Frontend Stack

### 🎯 Features

- ➕ زیادکردنی فۆنت
- 🗂️ لیستی فۆنتەکان
- ✏️ دەستکاریکردنی فۆنت
- ❌ سڕینەوەی فۆنت
- 🖥️ داشبۆردی بەڕێوەبردن

---

## 🛠️ Tech Stack

| Technology | Description |
|------------|-------------|
| PHP | Backend Language |
| Laravel | Web Framework |
| MySQL | Database |
| Node.js | JavaScript Runtime |
| Vite | Asset Bundler |
| Composer | PHP Dependency Manager |
| NPM | JS Package Manager |

---

# 🚀 Installation Guide

## 1️⃣ Clone the Repository

```bash
git clone https://github.com/nio-fa/fonts-library.git
cd fonts-library-main
```

---

## 2️⃣ Install Dependencies

### 📦 Install PHP Dependencies

```bash
composer install
```

### 📦 Install Node Dependencies

```bash
npm install
```

### 🏗️ Build Frontend Assets

```bash
npm run build
```

---

## 3️⃣ Environment Setup

### 📄 Copy Environment File

```bash
cp .env.example .env
```

### 🔐 Generate Application Key

```bash
php artisan key:generate
```

---

## 4️⃣ Database Configuration

لە فایل `.env` ئەم زانیاریانە ڕێکبخە:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

دڵنیابە کە داتابەیسەکەت دروستکراوە لە MySQL.

---

## 5️⃣ Run Database Migrations

```bash
php artisan migrate
```

---

## 6️⃣ Run the Application

### ▶️ Start Laravel Server

```bash
php artisan serve
```

### ▶️ Run Development Server

```bash
npm run dev
```

---

## 🌐 Access The Application

دوای دەستپێکردنی سێرڤەر:

```
http://127.0.0.1:8000
```

---

## 📂 Project Structure

```
fonts-library/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── .env
├── composer.json
├── package.json
└── README.md
```

---

## 🔄 Useful Commands

| Command | Description |
|---------|------------|
| php artisan serve | Run local server |
| php artisan migrate | Run migrations |
| php artisan migrate:fresh | Reset database |
| npm run dev | Run dev server |
| npm run build | Build production assets |

---

## ⚠️ Requirements

- PHP >= 8.x
- Composer
- Node.js >= 18.x
- MySQL
- Git

---

## 🤝 Contributing

1. Fork بکە
2. Branch دروست بکە
3. Commit بکە
4. Pull Request بنێرە

---

## 📜 License

This project is open-source and available under the MIT License.

---

## 👨‍💻 Author

Developed by **Nio-fa**  
GitHub: https://github.com/nio-fa
