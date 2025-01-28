<p><img alt="laravel" src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Laravel ecommerce/blog template

- With the AdminLTE 2.3.7
- With the TinyMCE editor
- Ability to create and edit article tags/categories
- Registration and user management
- Connecting the JS/CSS code to the website via the admin panel

## How to Install

- git clone THIS_REPO
- cp .env.example .env
- composer install
- php artisan key:generate
- create empty DB and config it into .env
- php artisan migrate
- php artisan storage:link
- `mkdir -p storage/framework/{sessions,views,cache}`
- ln -s /var/www/THIS_SITE/storage/app/public/ /var/www/THIS_SITE/html/public/storage
-
```
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs
```
- `npm install`
- `npx mix`
- fill all `MAIL_*` params in .env file for subscription functionality

- Optional:
    see how to create demo items in `Factories.md` file.

### Deployment
- git pull
- php artisan config:clear

## Telescope
The "Laravel Telescope" will be enabled when `TELESCOPE_ENABLED` is true.
Access will be if `APP_ENV` is local.
##### Installing
```
php artisan telescope:install
php artisan migrate
```
after updating:
`
php artisan telescope:publish
`

## Debugbar
The Debugbar will be enabled when APP_DEBUG is true.

#### Other
Чтобы создать фабрики, миграции, модели и ресурсный контроллер выполните:
```
php artisan make:model Post -a
```

Миграции заново:
```
php artisan migrate:refresh
```
A specific table fresh migration:
```
php artisan migrate:refresh --path=/database/migrations/fileName.php
```

### How to test and check honeypot
Open post with comment text field, after it open browser console and write:

```
document.querySelectorAll('input[name="countMe"]')[0].value;

let honeypot = document.getElementById('honeypot');
honeypot.value;
```

### cache
```
php artisan optimize:clear
composer dump-autoload
composer cc
```
