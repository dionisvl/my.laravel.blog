FROM php:8.0-fpm-alpine

LABEL MAINTAINER="<dionisvl3@gmail.com>"
LABEL RELEASEDATE="20211109"

# Setup some env
ENV \
	# Setup same composer home directory for all users
	COMPOSER_HOME="/usr/local/composer" \
	PHP_VERSION=php8.0

ARG XDEBUG_VERSION=3.1.1
ARG PHP_EXTENSIONS="bcmath pdo pdo_pgsql mysqli pdo_mysql pcntl zip curl opcache"

# prepare for postgreSql-apine:
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

# Install dependencies
RUN \
    cd /tmp \
    && apk add \
    libmcrypt-dev \
    curl-dev \
    #${PHP_VERSION}-openssl \
    libzip-dev \
    su-exec \
    && \
    docker-php-ext-install $PHP_EXTENSIONS

# ext-gd
RUN \
    cd /tmp \
    && apk add freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

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


RUN #mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./common/php/php-fpm.d /usr/local/etc/php-fpm.d


WORKDIR /app

HEALTHCHECK --interval=30s --timeout=3s --start-period=5s \
    CMD REDIRECT_STATUS=true SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET \
    cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1

