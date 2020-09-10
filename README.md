<p><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Laravel ecommerce/blog template

- С админкой "AdminLTE" 2.3.7
- С редактором TinyMCE
- Возможность создавать и редактировать теги/категории статей
- Регистрация и управление пользователями

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
sudo chown www-data -R /var/www/THIS_SITE/{\
storage/framework/cache,\
storage/framework/views,\
storage/framework/sessions,\
html/public/storage/uploads,\
bootstrap/cache,
}
```

- for subscription functionality fill all .env params - MAIL_FROM_ADDRESS

- Optional:  
    fill some test orders:
```
  php artisan tinker  
  factory(App\Order::class, 4)->create();  
```


## Telescope
The "Laravel Telescope" will be enabled when `TELESCOPE_ENABLED` is true.  
Access will be if `APP_ENV` is local.
##### Installing
``` 
php artisan telescope:install
php artisan migrate 
``` 
after updatig:  
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
Чтобы создать пользователя админа
```
php artisan tinker
\App\User::add(['name' => 'admin', 'email' => 'admin@admin.net', 'is_admin' => 1, 'password' => bcrypt('admin')]);
```
Миграции заново:
```
php artisan migrate:refresh
```
A specific table fresh migration:
```
php artisan migrate:refresh --path=/database/migrations/fileName.php
```
