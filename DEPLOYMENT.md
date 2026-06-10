# 🚀 Deployment Guide

## Quick Start

### 1. Clone Repository
```sh_bash
git clone https://github.com/Vickordon/vinnytsia-news-website.git
cd vinnytsia-news-website
```

### 2. Configure Database
Edit `database/config.php`:
```php
return [
    'host' => 'localhost',
    'dbname' => 'vinnytsia_news',
    'username' => 'your_username',
    'password' => 'your_password',
    // ...
];
```

### 3. Import Database
```sh_bash
mysql -u username -p database_name < database/schema.sql
```

### 4. Set Permissions
```sh_bash
change_mode 755 -R .
```

### 5. Access Application
- Frontend: `http://your-domain.com/`
- Admin: `http://your-domain.com/admin/`
- API: `http://your-domain.com/api/`

### Default Admin Credentials
- **Username:** admin
- **Password:** admin123
- ⚠️ Change immediately after first login!

## Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx with mod_rewrite

## Production Checklist
- [ ] Change admin password
- [ ] Update database credentials
- [ ] Set error reporting to 0 in config.php
- [ ] Enable HTTPS
- [ ] Configure backup system
- [ ] Set up monitoring

---
**Сайт Новин Вінничини** © 2026