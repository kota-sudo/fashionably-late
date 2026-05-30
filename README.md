# FashionablyLate

## Environment setup

```bash
docker compose up -d
docker compose exec php php artisan migrate:fresh --seed
```

## Tech stack

- Laravel 8
- PHP 8.1
- MySQL 8.0
- Docker
- Laravel Fortify

## ER diagram

_(ER diagram placeholder)_

## Application URL

http://localhost:8000/ (this project maps **80:80** in `docker-compose.yml`, so use http://localhost/)

## Table design

### users

| Column     | Type        | Notes        |
|------------|-------------|--------------|
| id         | bigint      | PK           |
| name       | string      |              |
| email      | string      | unique       |
| password   | string      |              |
| created_at | timestamp   |              |
| updated_at | timestamp   |              |

### categories

| Column     | Type        | Notes        |
|------------|-------------|--------------|
| id         | bigint      | PK           |
| content    | string      | category name |
| created_at | timestamp   |              |
| updated_at | timestamp   |              |

### contacts

| Column       | Type        | Notes                    |
|--------------|-------------|--------------------------|
| id           | bigint      | PK                       |
| category_id  | bigint      | FK → categories.id       |
| first_name   | string      |                          |
| last_name    | string      |                          |
| gender       | tinyInteger |                          |
| email        | string      |                          |
| tel          | string      |                          |
| address      | string      |                          |
| building     | string      | nullable                 |
| detail       | text        |                          |
| created_at   | timestamp   |                          |
| updated_at   | timestamp   |                          |
