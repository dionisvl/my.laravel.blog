## API Laravel

# Installation Steps

## Create New Laravel Project
cd app-php-laravel  
docker run --rm -v $(pwd):/app composer create-project --prefer-dist laravel/laravel:^10.0 api-laravel  

## Set Permissions and Install Dependencies
docker compose exec app-php-laravel chmod -R 775 /app/storage /app/bootstrap/cache  
docker compose exec app-php-laravel chown -R www-data:www-data /app  
docker compose exec app-php-laravel composer install --no-dev --optimize-autoloader  

## Configure Laravel Environment
docker compose exec app-php-laravel cp .env.example .env  
docker compose exec app-php-laravel php artisan key:generate  
docker compose exec app-php-laravel php artisan storage:link  

## Cache
php artisan config:clear  

## Sh
docker compose exec app-php-laravel sh

composer install --no-dev
