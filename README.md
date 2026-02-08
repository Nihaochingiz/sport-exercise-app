Фитнес-приложение для упражнений
Описание проекта
Веб-приложение на Laravel для просмотра и управления спортивными упражнениями. Пользователи могут просматривать упражнения с подробными инструкциями по выполнению, добавлять новые упражнения, редактировать существующие и удалять их.

Функционал
Просмотр списка упражнений

Детальный просмотр каждого упражнения с инструкциями

Добавление новых упражнений

Редактирование существующих упражнений

Удаление упражнений

Категоризация по группам мышц

Уровни сложности (начинающий, средний, продвинутый)

Поддержка упражнений на время и повторения

Технологии
Backend: Laravel 10

Frontend: Bootstrap 5, Blade шаблоны

База данных: PostgreSQL

Контейнеризация: Docker, Docker Compose

Веб-сервер: PHP built-in server

Структура проекта
text
sport-exercises-app/
├── app/
│   ├── Models/Exercise.php          # Модель упражнения
│   └── Http/Controllers/ExerciseController.php  # Контроллер
├── database/
│   ├── migrations/                  # Миграции БД
│   └── seeders/ExerciseSeeder.php   # Начальные данные
├── resources/views/exercises/       # Шаблоны
│   ├── index.blade.php              # Список упражнений
│   ├── show.blade.php               # Детали упражнения
│   ├── create.blade.php             # Форма добавления
│   └── edit.blade.php               # Форма редактирования
├── routes/web.php                   # Маршруты
├── docker-compose.yml               # Конфигурация Docker
├── Dockerfile                       # Образ приложения
└── .env                             # Настройки окружения
Быстрый старт
1. Клонирование и настройка
bash
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
Решение проблем
1. Ошибка "port already in use"
bash
# Остановите другие службы на портах 8000 или 5433
# Или измените порты в docker-compose.yml
2. Ошибка подключения к базе данных
bash
# Проверьте запущен ли PostgreSQL контейнер
docker-compose ps

# Проверьте логи PostgreSQL
docker-compose logs postgres

# Перезапустите контейнеры
docker-compose restart
3. Ошибка "Class not found"
bash
# Перегенерируйте автозагрузку Composer
docker-compose exec app composer dump-autoload

# Переустановите зависимости
docker-compose exec app composer install
4. Очистка данных
bash
# Удалить все упражнения
docker-compose exec app php artisan tinker
>>> \App\Models\Exercise::truncate();

# Очистить все данные (включая сессии)
docker-compose exec app php artisan migrate:fresh
Добавление изображений
Способ 1: Через форму
Перейдите на страницу создания/редактирования упражнения

Используйте поле загрузки изображений

Изображения сохраняются в storage/app/public/exercises/

Способ 2: Вручную
bash
# Создайте папку для изображений
mkdir -p storage/app/public/exercises

# Скопируйте изображения
cp ваши_изображения.jpg storage/app/public/exercises/

# Создайте симлинк
docker-compose exec app php artisan storage:link
Миграции и обновления
Обновление схемы базы данных
Создайте новую миграцию:

bash
docker-compose exec app php artisan make:migration add_column_to_exercises
Запустите миграции:

bash
docker-compose exec app php artisan migrate
Бэкап базы данных
bash
# Экспорт данных
docker-compose exec postgres pg_dump -U fitness_user fitness_db > backup.sql

# Импорт данных
docker-compose exec postgres psql -U fitness_user -d fitness_db < backup.sql
Производственная настройка
Настройка .env для продакшена
env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ваш-домен.com

# Настройки безопасности
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true

# Настройки базы данных для продакшена
DB_HOST=production-db-host
DB_PORT=5432
DB_DATABASE=production_db
DB_USERNAME=production_user
DB_PASSWORD=сильный_пароль
Оптимизация для продакшена
bash
# Оптимизация загрузки классов
docker-compose exec app composer install --optimize-autoloader --no-dev

# Кэширование конфигурации
docker-compose exec app php artisan config:cache

# Кэширование маршрутов
docker-compose exec app php artisan route:cache

# Кэширование представлений
docker-compose exec app php artisan view:cache
Мониторинг и логи
Просмотр логов
bash
# Логи приложения
docker-compose exec app tail -f storage/logs/laravel.log

# Логи веб-сервера
docker-compose logs app -f

# Логи базы данных
docker-compose logs postgres -f
Проверка здоровья приложения
bash
# Проверить доступность приложения
curl http://localhost:8000/health

# Проверить подключение к базе
docker-compose exec app php artisan db:monitor
Вклад в проект
Стиль кода
Следуйте стандартам PSR-12

Используйте английские названия переменных и функций

Комментируйте сложную логику

Рабочий процесс
Создайте ветку для новой функции

Добавьте тесты (если необходимо)

Обновите документацию

Создайте pull request

Лицензия
Этот проект является открытым и доступен для использования в образовательных и коммерческих целях.

Поддержка
При возникновении проблем:

Проверьте логи контейнеров

Убедитесь, что все порты свободны

Проверьте корректность настроек в .env файле

Создайте issue в репозитории проекта

Быстрая команда для запуска всего:

bash
docker-compose down && docker-compose up -d --build && sleep 10 && docker-compose exec app php artisan migrate --seed
Приложение готово к использованию по адресу: http://localhost:8000

