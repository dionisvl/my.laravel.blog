<p><img alt="laravel" src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Laravel ecommerce/blog template

- С админкой "AdminLTE" 2.3.7
- С редактором TinyMCE
- Возможность создавать и редактировать теги/категории статей
- Регистрация и управление пользователями
- Подключение кода JS/CSS на сайт через админку

## How to Install

- git clone THIS_REPO
- cp .env.example .env
- composer install
- php artisan key:generate
- create empty DB and config it into .env
- php artisan migrate
- php artisan storage:link
- ln -s /var/www/THIS_SITE/storage/app/public/ /var/www/THIS_SITE/html/public/storage
```
chown www-data -R /app/storage/logs/
chown www-data -R /app/storage/clockwork/
chown www-data -R /app/storage/framework/
chown www-data -R /app/bootstrap/cache/
chown www-data -R /var/www/phpqa.ru/app/storage/app/public/
chown www-data -R /app/storage/app/public/
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

### How to generate laravel request with namespace

```
php artisan make:request Post\AddPostRequest
```

### cache
```
php artisan optimize:clear
composer dump-autoload
composer cc
```

#### mysql
`mysql -u root -p -h mysql_phpqa`
