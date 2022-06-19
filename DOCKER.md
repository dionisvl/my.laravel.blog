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

### Installation to Dev
- make sure that you have installed php and nginx on your wsl2 system
- make sure that you have file phpqa.local.conf in /etc/nginx/sites-available/
- make sure that you have file .env in root directory of project with params:
```
# Gateway
GATEWAY_HOTS_PORT=80
GATEWAY_DOCKER_PORT=80
```
- `make init` or `docker compose up --build`
- `make composer-install`
- create database if not exists with name `my.laravel.blog`
- `make migrate`
- open url - http://phpqa.local:8080/

#### Optional:
- check current DataBase IP by command:
    - Linux variant: `docker inspect mysql_phpqa | grep IPAddress`
    - Windows variant: `docker inspect mysql_phpqa | findstr IPAddress`
- your config for connection from OS: `DATABASE_URL="mysql://root:root@127.0.0.1:8989/my.laravel.blog?serverVersion=8.0`
- your config for connection from docker (and Adminer): `DATABASE_URL="mysql://root:root@172.18.0.2:8989/my.laravel.blog?serverVersion=8.0"`
- Adminer example working url for PG:
    - http://localhost:8080/?pgsql=172.19.0.2&username=root
- enter to container `docker ps -a`,
  `docker exec -ti {{ container name }} /bin/sh`
  `docker exec -ti phpqarud_php-fpm_1 /bin/sh`
- `chmod 644 data/db/mysql/my.cnf`

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
