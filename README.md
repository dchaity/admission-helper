# 🎓 University Admission Helper

<div align="center">

![Sky Blue Theme](https://img.shields.io/badge/theme-sky%20blue-0ea5e9?style=for-the-badge)
![PHP](https://img.shields.io/badge/backend-PHP%207.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/database-MySQL%205.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/frontend-Vanilla%20JS-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)

**A comprehensive web platform for Bangladeshi students to manage university admissions — check eligibility, bookmark universities, apply for scholarships, and track their progress.**

[🌐 Live Demo](https://admissionhelper.free.nf) · [🐛 Report Bug](https://github.com/YOUR_USERNAME/admission-helper/issues) · [✨ Request Feature](https://github.com/YOUR_USERNAME/admission-helper/issues)

</div>

---

## 📖 Table of Contents

- [About the Project](#-about-the-project)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Project Structure](#-project-structure)
- [Getting Started](#-getting-started)
- [Usage](#-usage)
- [Security](#-security)
- [API Endpoints](#-api-endpoints)
- [Roadmap](#-roadmap)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## 🎯 About the Project

**University Admission Helper** is a free, all-in-one platform designed specifically for **Bangladeshi students** preparing for university admissions. It simplifies the entire admission journey by:

- Automatically checking which universities a student is eligible for based on their SSC/HSC GPA and academic group
- Providing a complete, up-to-date list of **163 universities** (53 public + 110 private) in Bangladesh
- Enabling students to bookmark and track favorite universities
- Offering scholarship discovery and application in one place
- Giving admins a hidden dashboard to manage students and monitor applications

The platform is **completely free** for students, runs on **free hosting** (InfinityFree), and is built with a **lightweight stack** (PHP + vanilla JavaScript) so it loads fast even on slow connections.

> 💡 **Why this project?** Navigating university admissions in Bangladesh is confusing — different GPA requirements, admission test formats, and deadlines across 163 universities. This platform puts everything in one place.

---

## ✨ Features

### 🎓 For Students

| Feature | Description |
|---------|-------------|
| 🔐 **Secure Registration** | Sign up with email, phone, GPA, and academic group |
| 🎯 **Eligibility Checker** | Instantly see which universities match your GPA and group |
| 🏛️ **Browse 163 Universities** | Complete UGC-approved list of public and private universities |
| 🏙️ **Filter by City** | Find universities in Dhaka, Chittagong, Rajshahi, and 30+ other cities |
| 🔖 **Bookmark System** | Save favorite universities for quick access later |
| 💰 **Scholarship Discovery** | Browse 35+ scholarships across top universities |
| 📝 **Apply for Scholarships** | Submit applications directly through the platform |
| 📊 **Personal Dashboard** | Track eligible programs, bookmarks, and applications |
| 📝 **Admission Test Guides** | Detailed test-format articles for all public universities |
| 🌙 **Dark Mode Toggle** | Comfortable browsing day or night |
| 📱 **Fully Responsive** | Works seamlessly on mobile, tablet, and desktop |

### 🛡️ For Admins

| Feature | Description |
|---------|-------------|
| 🔒 **Hidden Admin Panel** | Not visible to regular users; accessible via secret shortcut |
| 👥 **Student Management** | View all registered students with their details |
| 📊 **Platform Statistics** | Total students, scholarship applications, etc. |
| 📝 **Application Tracking** | See all scholarship applications with student info |
| 🔐 **Multi-Layer Security** | Admin access enforced at UI, JS, API, and DB levels |

### 🎨 Design Highlights

- 🌤️ **Sky Blue Light Theme** (default) — modern, clean, calming
- 🌙 **Dark Mode** — reduced eye strain at night
- ✨ **Smooth Animations** — page transitions, hover effects, gradients
- 🎯 **Intuitive UX** — auto-scroll, focus states, inline validation
- 🍪 **Cookie Consent Banner** — GDPR-friendly
- 📱 **Mobile-first Layout** — responsive breakpoints for all screen sizes

---

## 🛠️ Tech Stack

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Frontend** | HTML5 | Semantic markup |
| | CSS3 (Custom Properties) | Sky blue theme, responsive design |
| | Vanilla JavaScript (ES6+) | Interactive UI, API calls, state management |
| **Backend** | PHP 7.4+ | REST API endpoints |
| | PDO | Secure database abstraction |
| **Database** | MySQL 5.7+ / MariaDB | Data storage |
| **UI Libraries** | Font Awesome 6 | Icons |
| | Google Fonts (Inter) | Typography |
| **Hosting** | InfinityFree | Free PHP + MySQL hosting |

### Why This Stack?

- ✅ **No build step** — edit and deploy directly
- ✅ **No frameworks** — lightweight, fast, easy to understand
- ✅ **Works on free hosting** — no Node.js, Docker, or complex setup required
- ✅ **Beginner-friendly** — great learning project for web development

---

## 📸 Screenshots

> Add your own screenshots by uploading images to GitHub and replacing the URLs below.

| Home Page | Universities |
|-----------|-------------|
| ![Home](https://via.placeholder.com/600x350/0ea5e9/ffffff?text=Home+Page) | ![Universities](https://via.placeholder.com/600x350/38bdf8/ffffff?text=Universities) |

| Dashboard | Scholarships |
|-----------|-------------|
| ![Dashboard](https://via.placeholder.com/600x350/0284c7/ffffff?text=Student+Dashboard) | ![Scholarships](https://via.placeholder.com/600x350/0ea5e9/ffffff?text=Scholarships) |

---

## 📁 Project Structure
admission-helper/
│
├── index.html                    # Single-page application
├── .htaccess                     # Apache config (HTTPS + security)
├── .gitignore                    # Git ignore rules
├── README.md                     # Documentation
├── LICENSE                       # MIT License
├── database.sql                  # Full DB schema + sample data
│
└── api/                          # PHP backend (REST API)
    │
    ├── config.php                # DB connection + helpers
    ├── register.php              # POST — student registration
    ├── login.php                 # POST — authentication
    ├── logout.php                # POST — destroy session
    ├── profile.php               # GET/POST — user profile
    ├── settings.php              # POST — change password
    │
    ├── universities.php          # GET — list universities
    ├── scholarships.php          # GET — list scholarships
    │
    ├── bookmark.php              # POST — toggle bookmark
    ├── bookmarks.php             # GET — user bookmarks
    │
    ├── dashboard.php             # GET — dashboard stats
    ├── apply.php                 # POST — apply for scholarship
    ├── my-scholarship-apps.php   # GET — user applications
    │
    └── admin/                    # Admin-only endpoints
        ├── .htaccess             # Blocks non-PHP file access
        ├── stats.php             # GET — platform statistics
        ├── users.php             # GET — registered students
        └── scholarship_apps.php  # GET — all applications
```

### Folder Overview

| Path | Purpose |
|------|---------|
| `index.html` | Single-page frontend (all UI in one file) |
| `api/` | PHP backend — all REST endpoints |
| `api/admin/` | Admin-only endpoints, protected by `requireAdmin()` |
| `database.sql` | Complete schema + 163 universities + 35 scholarships |

## 🚀 Getting Started

### Prerequisites

| Requirement | Version | Notes |
|-------------|---------|-------|
| **PHP** | 7.4+ | With PDO MySQL extension |
| **MySQL** | 5.7+ | Or MariaDB 10.3+ |
| **Web Server** | Apache/Nginx | Or use XAMPP/Laragon |
| **Git** | Latest | For cloning the repo |
| **Browser** | Modern | Chrome, Firefox, Edge, Safari |

**Easiest local setup:** Install [XAMPP](https://www.apachefriends.org/) — includes Apache, PHP, and MySQL in one package.

---

### Installation

#### 1. Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/admission-helper.git
cd admission-helper

