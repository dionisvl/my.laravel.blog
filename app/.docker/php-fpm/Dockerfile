FROM php:8.2.12-fpm-bookworm

LABEL MAINTAINER="<dionisvl3@gmail.com>"
LABEL RELEASEDATE="20211109"

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libgd-dev \
        cron \
        libpq-dev \
        procps \
        htop \
        nano \
        bash-completion \
    && docker-php-ext-install \
        gd \
        mysqli \
        pdo_mysql \
        mbstring \
        curl \
        xml \
        bcmath \
        zip \
        exif \
        pdo_pgsql \
        pgsql

# Ensure the directory for additional ini files is available
COPY ./php-fpm/conf.d /usr/local/etc/php/conf.d
COPY ./php-fpm/php-fpm.d /usr/local/etc/php-fpm.d

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# bash как оболочка по умолчанию
SHELL ["/bin/bash", "-c"]

## CRON start
# Add crontab file in the cron directory
RUN rm /bin/sh
RUN ln -s /bin/bash /bin/sh
# Create the log file to be able to run tail
RUN touch /var/log/cron.log
RUN chmod 0777 /var/log/cron.log
ADD ./php-fpm/crontab /etc/cron.d/schedule-cron
# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/schedule-cron
# Apply cron job
RUN crontab /etc/cron.d/schedule-cron

## CRON end

# Clean up apt cache to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set the working directory for PHP
WORKDIR /app

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Run PHP-FPM on container start
CMD cron && docker-php-entrypoint php-fpm

HEALTHCHECK --interval=60s --timeout=55s --start-period=50s \
    CMD REDIRECT_STATUS=true SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET \
    cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1
