<p><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>  

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
sudo chmod -R 777 /var/www/phpqa.ru/{\
storage/framework/cache,\
storage/framework/views,\
storage/framework/sessions,\
bootstrap/cache}
```
- Optional:  
    fill some test orders:
    ```
  php artisan tinker  
  factory(App\Order::class, 4)->create();  
  ```
## Интернет магазин на Ларавеле

- С админкой "AdminLTE" 2.3.7
- С редактором TinyMCE
- Возможность создавать и редактировать теги/категории статей
- Регистрация и управление пользователями


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


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
