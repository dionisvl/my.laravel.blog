#!/bin/bash

TARGET_DIR="app-laravel/api-laravel"

# Устанавливаем 644 для всех файлов, кроме исполняемых скриптов
find "$TARGET_DIR" -type f -exec chmod 644 {} +

# Оставляем 755 только для .sh, .py и .php скриптов
find "$TARGET_DIR" -type f \( -name "*.sh" -o -name "*.py" -o -name "*.php" \) -exec chmod 755 {} +

echo "Файловые права в '$TARGET_DIR' исправлены."
