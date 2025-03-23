FROM php:8.3.19-fpm-alpine3.21

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    # Base utils
    bash \
    nano \
    htop \
    bash-completion \
    # PHP and extensions
    php83-common \
    php83-gd \
    php83-mysqli \
    php83-pdo_mysql \
    php83-mbstring \
    php83-curl \
    php83-xml \
    php83-bcmath \
    php83-zip \
    php83-exif \
    php83-pdo_pgsql \
    php83-pgsql \
    php83-opcache \
    php83-calendar \
    php83-ctype \
    php83-ffi \
    php83-fileinfo \
    php83-ftp \
    php83-gettext \
    php83-intl \
    php83-phar \
    php83-posix \
    php83-session \
    php83-shmop \
    php83-sockets \
    php83-sysvmsg \
    php83-sysvsem \
    php83-sysvshm \
    php83-tokenizer \
    php83-pecl-amqp \
    # Runtime libraries
    oniguruma \
    libxml2 \
    curl \
    freetype \
    libgd \
    postgresql-libs \
    icu \
    gettext \
    libffi \
    rabbitmq-c \
    openssl \
    linux-headers # Required for pecl

# Install PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql

# Install Xdebug with necessary dependencies
RUN apk add --no-cache $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apk del $PHPIZE_DEPS

# Install AMQP extension
RUN apk add --no-cache $PHPIZE_DEPS rabbitmq-c-dev && \
    pecl install amqp && \
    docker-php-ext-enable amqp && \
    apk del $PHPIZE_DEPS

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure PHP
COPY php/conf.d/custom.ini /usr/local/etc/php/conf.d/
COPY php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/

# Setup supervisor
COPY supervisor/supervisord.conf /etc/supervisord.conf

# Copy nginx configuration
COPY nginx/app.conf /etc/nginx/http.d/default.conf

# Create necessary directories and set permissions
RUN mkdir -p /run/nginx /var/log/supervisor /app \
    && chown -R www-data:www-data /app \
    && chmod -R 755 /app

WORKDIR /app

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
