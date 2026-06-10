# Vinnytsia News API

RESTful API for the Vinnytsia News Website.

## Base URL
```
/api/
```

## Endpoints

### Articles
- `GET /api/articles.php` - List all articles
- `GET /api/articles.php?id=X` - Get single article
- `POST /api/articles.php` - Create article (auth required)
- `PUT /api/articles.php` - Update article (auth required)
- `DELETE /api/articles.php?id=X` - Delete article (auth required)

### Authentication
- `POST /api/auth.php` - Login/Register
  ```json
  {
    "action": "login",
    "username": "admin",
    "password": "admin123"
  }
  ```

### Categories
- `GET /api/categories.php` - List all categories
- `GET /api/categories.php?id=X` - Get single category

### Comments
- `GET /api/comments.php?article_id=X` - Get comments for article
- `POST /api/comments.php` - Add comment

### Search
- `GET /api/search.php?q=query` - Search articles

### Users
- `GET /api/users.php` - List users (admin only)
- `POST /api/users.php` - Register user

## Response Format

All responses are in JSON format:

```json
{
  "success": true,
  "data": {},
  "error": null
}
```

## Authentication

Some endpoints require authentication. Include session cookie or JWT token in request headers.