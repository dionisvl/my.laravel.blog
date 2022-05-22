# Nginx PHP MySQL

Docker running Nginx, PHP-FPM, MySQL and PHPMyAdmin.

## Installation to production by docker-compose
- go to provision directory and prepare target servers
    - cd pro*
    - make site
    - make authorize
    - make generate-deploy-key
    - make authorize-deploy
    - docker-login
- return to main directory and deploy project to target servers by example command:
    - `make deploy`

### Installation
- `docker volume create --name=pgdata` (https://forums.docker.com/t/data-directory-var-lib-postgresql-data-pgdata-has-wrong-ownership/17963/31)
- docker compose up --build
- composer install
- create database if not exists with name "my.symf.test"
- check current DataBase IP by command:
  linux variant: `docker inspect phpqarud_mysql-db_1 | grep IPAddress`/`docker inspect postgres | grep IPAddress`
  win variant: `docker inspect myphpqad-pg-db-1 | findstr IPAddress`
- your config for connection from OS: `DATABASE_URL="mysql://root:root@127.0.0.1:8989/my.symf.test?serverVersion=8.0`
- your config for connection from docker (and Adminer): `DATABASE_URL="mysql://root:root@172.18.0.2:3306/my.symf.test?serverVersion=8.0"`
- Adminer example working url for PG:
  http://localhost:8080/?pgsql=172.19.0.2&username=root
- `php bin/console doctrine:migrations:migrate`
- `php bin/console doctrine:fixtures:load`
- open url - http://localhost:8000/

- enter to container `docker ps -a`,
  `docker exec -ti {{ container name }} /bin/sh`
  `docker exec -ti phpqarud_php-fpm_1 /bin/sh`

### Images to use

* [Nginx](https://hub.docker.com/_/nginx/)
* [MySQL](https://hub.docker.com/_/mysql/)
* [PHP-FPM](https://hub.docker.com/r/nanoninja/php-fpm/)
* [Composer](https://hub.docker.com/_/composer/)
* [PHPMyAdmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)
* [Generate Certificate](https://hub.docker.com/r/jacoelho/generate-certificate/)

You should be careful when installing third party web servers such as MySQL or Nginx.

This project use the following ports :

| Server          | Port | port internal |
|-----------------|------|---------------|
| Nginx           | 8000 |               |
| Nginx SSL       | 3000 |               |
| Optional pg:    |      |               |
| PostgreSQL      | 5432 |   5432        |
| Adminer         | 8080 |               |
| Optional mysql: |      |               |
| MySQL           | 8989 |  3306         |
| PHPMyAdmin      | 8080 |               |

#### Connecting MySQL from [PDO](http://php.net/manual/en/book.pdo.php)

```php
<?php
    try {
        $dsn = 'mysql:host=mysql;dbname=test;charset=utf8;port=3306';
        $pdo = new PDO($dsn, 'dev', 'dev');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
```

___

### Sources

- https://github.com/nanoninja/docker-nginx-php-mysql

## Настройки на хосте
В файле hosts добавить
```
127.0.0.1 phpqa.local
```
