## API Laravel

# Installation Steps

## Create New Laravel Project
cd app-laravel  
docker run --rm -v $(pwd):/app composer create-project --prefer-dist laravel/laravel:^10.0 api-laravel  

## Set Permissions and Install Dependencies
docker compose exec php-fpm chmod -R 775 /app/storage /app/bootstrap/cache  
docker compose exec php-fpm chown -R www-data:www-data /app  
docker compose exec php-fpm composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd --ignore-platform-req=ext-zip  

## Configure Laravel Environment
docker compose exec php-fpm cp .env.example .env  
docker compose exec php-fpm php artisan key:generate  
docker compose exec php-fpm php artisan storage:link  

## Cache
php artisan config:clear  

## Sh
docker compose exec php-fpm sh

composer install --no-dev
