# 📰 Сайт Новин Вінничини (Vinnytsia News Website)

A comprehensive PHP-based news website for Vinnytsia region, Ukraine.

## 🚀 Project Overview

**Сайт Новин** is a full-featured news platform built with PHP, featuring:
- User authentication and registration
- News article management with categories
- Comment system
- Admin panel for content management
- RESTful API
- Responsive design
- Security features (SQL injection prevention, XSS protection, CSRF tokens)

## 📁 Project Structure

```
vinnytsia-news-website/
├── index.php                 # Main homepage
├── article.php               # Article display page
├── category.php              # Category listing
├── search.php                # Search functionality
├── login.php                 # User login
├── register.php              # User registration
├── logout.php                # User logout
├── add_comment.php           # Comment submission
├── config.php                # Main configuration
│
├── api/                      # REST API endpoints
│   ├── articles.php
│   ├── auth.php
│   ├── categories.php
│   ├── comments.php
│   ├── search.php
│   ├── users.php
│   ├── ApiResponse.php
│   └── README.md
│
├── admin/                    # Admin panel
│   ├── index.php             # Dashboard
│   ├── articles.php          # Article management
│   ├── article_edit.php      # Edit/Create articles
│   ├── categories.php        # Category management
│   ├── comments.php          # Comment moderation
│   ├── admin.html            # Static admin page
│   ├── css/admin.css
│   ├── js/admin.js
│   └── includes/             # Admin components
│
├── src/                      # Core PHP classes
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Category.php
│   │   ├── Comment.php
│   │   └── User.php
│   ├── Validator.php
│   └── ApiResponse.php
│
├── database/                 # Database layer
│   ├── config.php
│   ├── Database.php
│   ├── schema.sql
│   └── README.md
│
├── includes/                 # Shared components
│   ├── header.php
│   ├── footer.php
│   └── functions.php
│
├── css/                      # Frontend stylesheets
│   ├── variables.css
│   ├── base.css
│   ├── layout.css
│   ├── news-listing.css
│   ├── article.css
│   └── admin.css
│
├── js/                       # Frontend JavaScript
│   ├── main.js
│   └── admin.js
│
├── docs/                     # Documentation
│   └── PROJECT_REQUIREMENTS.md
│
└── test/                     # Testing documentation
    ├── TEST_PLAN.md
    ├── TEST_CASES.md
    ├── DEPLOYMENT_CHECKLIST.md
    └── ... (more test docs)
```

## 🛠️ Features

### Frontend
- 📱 Responsive design for mobile and desktop
- 🔍 Search functionality
- 📂 Category-based news browsing
- 💬 Comment system
- 👤 User authentication (login/register)
- 🎨 Modern CSS with CSS variables

### Backend
- 🔐 Secure authentication with bcrypt password hashing
- 🛡️ SQL injection prevention
- 🚫 XSS protection
- 🔑 CSRF token protection
- 📊 RESTful API
- 🗄️ Database abstraction layer

### Admin Panel (CMS)
- 📈 Dashboard with statistics
- ✏️ Article CRUD operations
- 🏷️ Category management
- 💬 Comment moderation
- 👥 User management

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (optional)
- Web server (Apache/Nginx)

### Installation

1. **Clone the repository**
   ```sh_bash
   git clone https://github.com/Vickordon/vinnytsia-news-website.git
   cd vinnytsia-news-website
   ```

2. **Configure database**
   ```sh_bash
   # Edit database/config.php with your credentials
   ```

3. **Import database schema**
   ```sh_bash
   mysql -u username -p database_name < database/schema.sql
   ```

4. **Configure application**
   ```sh_bash
   # Edit config.php with your settings
   ```

5. **Set permissions**
   ```sh_bash
   change_mode 755 -R .
   change_mode 777 uploads/  # if using file uploads
   ```

6. **Access the application**
   - Frontend: `http://localhost/vinnytsia-news-website/`
   - Admin Panel: `http://localhost/vinnytsia-news-website/admin/`
   - API: `http://localhost/vinnytsia-news-website/api/`

### Default Admin Account
- **Username:** admin
- **Password:** admin123 (change immediately!)

## 📡 API Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `/api/articles.php` | GET | List all articles |
| `/api/articles.php?id=X` | GET | Get single article |
| `/api/auth.php` | POST | Login/Register |
| `/api/categories.php` | GET | List categories |
| `/api/comments.php` | GET/POST | Get/Submit comments |
| `/api/search.php?q=query` | GET | Search articles |
| `/api/users.php` | GET/POST | User management |

See [`api/README.md`](api/README.md) for full API documentation.

## 🧪 Testing

Comprehensive testing documentation is available in the `/test/` directory:

- Test Plan
- Test Cases (58 requirements mapped)
- Backend Test Results (96% pass rate)
- Frontend Test Results (84% pass rate)
- Security Test Results (100% pass rate)
- Deployment Checklist
- Integration Test Guide

## 📊 Project Status

**Current Status:** Integration Phase (90% Complete)

| Component | Status | Test Pass Rate |
|-----------|--------|----------------|
| Backend API | ✅ Ready | 96% |
| Frontend UI | ✅ Ready | 84% |
| Database | ✅ Ready | 100% |
| Security | ✅ Ready | 100% |
| CSS/JS | ✅ Ready | 100% |

**Target Deployment Date:** June 15, 2026

## 🔒 Security Features

- ✅ SQL Injection Prevention (Prepared Statements)
- ✅ XSS Protection (Input Sanitization)
- ✅ Password Hashing (bcrypt)
- ✅ CSRF Token Protection
- ✅ Session Management
- ✅ Input Validation

## 📝 License

This project is open source and available for educational and commercial use.

## 👥 Team

- **CEO:** Project Leadership
- **Project Manager:** Coordination & Deployment
- **Backend Developers:** PHP API & Database
- **Frontend Developer:** UI/UX Implementation
- **QA Tester:** Testing & Quality Assurance

## 📞 Contact

For questions or contributions, please open an issue on GitHub.

---

**Сайт Новин Вінничини** - Your source for Vinnytsia region news! 🇺🇦
