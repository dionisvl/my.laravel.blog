# Docker

Поднять Docker Compose со сборкой

```
docker-compose up --build
```

## Настройки на хосте

В файле hosts добавить

```
127.0.0.1 phpqa.local
```

Открыть проект можно сразу по ссылке  
http://localhost/

### phpMyAdmin

http://localhost:8088/

### MySQL

Настройка подключения хранилища файлов:

- в Docker Desktop добавить 2 пути в Resources - File Sharing:  
  -- путь до всего проекта для возможности подрузить my.cnf  
  -- путь до db_data
- Перезагрузить весь docker desktop полностью.  
