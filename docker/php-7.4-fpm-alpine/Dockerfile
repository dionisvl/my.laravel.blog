FROM php:7.4-fpm-alpine

LABEL MAINTAINER="<dionisvl3@gmail.com>"
LABEL RELEASEDATE="20211109"

# Setup some env
ENV \
	# Setup same composer home directory for all users
	COMPOSER_HOME="/usr/local/composer" \
	PHP_VERSION=php7.4

ARG XDEBUG_VERSION=3.1.1
ARG PHP_EXTENSIONS="bcmath pdo mysqli pdo_mysql pcntl zip"

# Install dependencies
RUN \
    cd /tmp \
    && apk add \
    libmcrypt-dev \
    # php-common includes: curl, fileinfo, json, phar, zip, pear
    #${PHP_VERSION}-common \
    #${PHP_VERSION}-openssl \
    libzip-dev \
    su-exec \
    && docker-php-ext-install $PHP_EXTENSIONS

# ex-gd
RUN \
    cd /tmp \
    && apk add libpng libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev gd \
    && docker-php-ext-install gd

# pm.max_children = 25
ADD ./www.conf /usr/local/etc/php-fpm.d/www.conf

# tweak custom php-fpm config
ADD ./myPhp.ini /usr/local/etc/php/conf.d/05-php.ini


# Build dependencies.
ENV BUILD_DEPS \
    autoconf \
    g++ \
    make

ENV LANG=ru_RU.UTF-8 \
    LANGUAGE=ru_RU.UTF-8 \
    LC_LANG=ru_RU.UTF-8 \
    LC_ALL=ru_RU.UTF-8

RUN \
	#
	# helper packages
	apk add \
        nano \
        wget \
    #    nmap \
    #    ssmtp \
    #
    # system temp packages
    && cd /tmp \
    && apk add --virtual .build-deps $BUILD_DEPS \
    #
    # Xdebug
    # for "pecl install xdebug" we need three packages: autoconf, g++ and make
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    #
    && apk del .build-deps


RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

# Configure XDebug.
COPY xdebug.ini /usr/local/etc/php/conf.d/20-xdebug.ini

# Laravel logs access fix
RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

WORKDIR /var/www