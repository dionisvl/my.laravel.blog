# Laravel FrontParts

Модуль для хранения и управления динамическими частями фронта: блоками JS-CSS кода и т.п.

##### Example of use seeds from package:
```
php artisan db:seed --class="Dionisvl\FrontParts\Database\Seeds\DatabaseSeeder"
```
##### A specific table fresh migration:
```
php artisan migrate:refresh --path=\packages\frontparts\src\database\migrations\2020_09_06_144050_create_frontparts_table.php
```
