FROM php:8.3-fpm-alpine

# Add PHP repository and system dependencies
RUN apk add --no-cache ca-certificates && \
   apk add --no-cache --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community/ php83

# System utilities
RUN apk add --no-cache \
   nginx \
   supervisor \
   bash \
   nano \
   htop \
   dcron \
   bash-completion

# Install build dependencies
RUN apk add --no-cache --virtual .build-deps \
   $PHPIZE_DEPS \
   freetype-dev \
   libjpeg-turbo-dev \
   libpng-dev \
   libzip-dev \
   icu-dev \
   oniguruma-dev \
   postgresql-dev \
   rabbitmq-c-dev

# PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
   docker-php-ext-install -j$(nproc) \
   gd \
   pdo \
   pdo_mysql \
   pdo_pgsql \
   bcmath \
   opcache \
   intl \
   zip \
   pcntl \
   sockets \
   session

# Runtime libraries
RUN apk add --no-cache \
   libzip \
   libpng \
   oniguruma \
   libxml2 \
   curl \
   freetype \
   libjpeg-turbo \
   libgd \
   postgresql-libs \
   icu \
   gettext \
   libffi \
   rabbitmq-c \
   openssl

# Install PECL extensions
RUN pecl install xdebug amqp && \
   docker-php-ext-enable xdebug amqp

# Install additional PHP extensions
RUN apk add --no-cache \
   php83-common \
   php83-session \
   php83-redis \
   php83-mbstring \
   php83-xml \
   php83-exif \
   php83-calendar \
   php83-ctype \
   php83-ffi \
   php83-fileinfo \
   php83-ftp \
   php83-gettext \
   php83-iconv \
   php83-phar \
   php83-posix \
   php83-shmop \
   php83-sysvmsg \
   php83-sysvsem \
   php83-sysvshm \
   php83-tokenizer

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cleanup
RUN apk del .build-deps && \
   rm -rf /tmp/* /var/cache/apk/*

# Create necessary directories and set permissions
RUN mkdir -p /run/nginx /var/log/supervisor /app \
   && chown -R www-data:www-data /app \
   && chmod -R 755 /app

# Your configuration files
COPY php/conf.d/ /etc/php83/conf.d/
COPY php/php-fpm.d/www.conf /etc/php83/php-fpm.d/
COPY supervisor/supervisord.conf /etc/supervisord.conf
COPY /app/nginx/app.conf /etc/nginx/http.d/default.conf

# Setup cron
RUN touch /var/log/cron.log && chmod 0777 /var/log/cron.log
COPY cron/schedule-cron /etc/cron.d/
RUN chmod 0644 /etc/cron.d/schedule-cron
RUN crontab /etc/cron.d/schedule-cron

WORKDIR /app

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
