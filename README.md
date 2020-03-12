<p><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>  

## How to Install

- git clone THIS_REPO
- cp .env.example .env
- php artisan key:generate
- composer install
- create empty DB and config it into .env
- php artisan migrate

## Блог на Ларавеле

- С админкой "AdminLTE" 2.3.7
- С редактором CkEditor
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
