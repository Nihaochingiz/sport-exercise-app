sport-exercises-app/
├── app/
│ ├── Models/Exercise.php # Модель упражнения
│ └── Http/Controllers/ExerciseController.php # Контроллер
├── database/
│ ├── migrations/ # Миграции БД
│ └── seeders/ExerciseSeeder.php # Начальные данные
├── resources/views/exercises/ # Шаблоны
│ ├── index.blade.php # Список упражнений
│ ├── show.blade.php # Детали упражнения
│ ├── create.blade.php # Форма добавления
│ └── edit.blade.php # Форма редактирования
├── routes/web.php # Маршруты
├── docker-compose.yml # Конфигурация Docker
├── Dockerfile # Образ приложения
└── .env # Настройки окружения

text

## Быстрый старт

### 1. Клонирование и настройка

```bash
# Клонируйте репозиторий (если есть)
git clone <ваш-репозиторий>
cd sport-exercises-app

# Если проект уже создан, просто перейдите в папку
cd sport-exercises-app
2. Запуск через Docker (рекомендуется)
bash
# Собрать и запустить контейнеры
docker-compose up -d --build

# Выполнить миграции базы данных
docker-compose exec app php artisan migrate

# Заполнить базу начальными данными
docker-compose exec app php artisan db:seed --class=ExerciseSeeder
3. Доступ к приложению
Приложение: http://localhost:8000

База данных: PostgreSQL на порту 5433

Хост: localhost

Порт: 5433

База: fitness_db

Пользователь: fitness_user

Пароль: fitness_password

Ручная установка (без Docker)
Требования
PHP 8.2+

Composer

PostgreSQL 15+

Node.js 18+ (опционально)

Установка
bash
# 1. Установите зависимости Laravel
composer install

# 2. Скопируйте файл окружения
cp .env.example .env

# 3. Сгенерируйте ключ приложения
php artisan key:generate

# 4. Настройте базу данных в .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=fitness_db
DB_USERNAME=fitness_user
DB_PASSWORD=fitness_password

# 5. Запустите миграции
php artisan migrate

# 6. Заполните базу данных
php artisan db:seed --class=ExerciseSeeder

# 7. Запустите сервер разработки
php artisan serve
Docker команды
Основные команды
bash
# Запуск контейнеров
docker-compose up -d

# Остановка контейнеров
docker-compose down

# Пересборка образов
docker-compose build --no-cache

# Просмотр логов
docker-compose logs app
docker-compose logs postgres

# Вход в контейнер приложения
docker-compose exec app bash

# Вход в базу данных
docker-compose exec postgres psql -U fitness_user -d fitness_db
Управление базой данных
bash
# Запустить миграции
docker-compose exec app php artisan migrate

# Откатить миграции
docker-compose exec app php artisan migrate:rollback

# Сбросить и перезапустить миграции
docker-compose exec app php artisan migrate:fresh --seed

# Запустить конкретный сидер
docker-compose exec app php artisan db:seed --class=ExerciseSeeder
Структура базы данных
Таблица exercises
sql
CREATE TABLE exercises (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    instructions TEXT NOT NULL,
    muscle_group VARCHAR(255),
    duration_seconds INTEGER,
    reps INTEGER,
    difficulty VARCHAR(20) DEFAULT 'beginner',
    images JSON,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
Начальные данные
Приложение включает 5 предустановленных упражнений:

Приседания - для ног и ягодиц

Отжимания - для груди, трицепсов и плеч

Leg Raises - для пресса

Mountain Climbers - кардио для всего тела

Hollow Hold - статическое упражнение для кора

Разработка
Создание нового упражнения через код
bash
# Создать новую миграцию
docker-compose exec app php artisan make:migration add_new_column_to_exercises

# Создать новый контроллер
docker-compose exec app php artisan make:controller NewController

# Создать новую модель
docker-compose exec app php artisan make:model NewModel -m
Тестирование
bash
# Запустить тесты (если есть)
docker-compose exec app php artisan test

# Проверить состояние приложения
docker-compose exec app php artisan about
```
