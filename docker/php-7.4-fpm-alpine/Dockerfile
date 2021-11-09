FROM php:7.4-fpm-alpine

# Setup some env
ENV \
	# Setup same composer home directory for all users
	COMPOSER_HOME="/usr/local/composer" \
	PHP_VERSION=php7.4

ARG XDEBUG_VERSION=3.1.1
ARG PHP_EXTENSIONS="mysqli pdo_mysql"

# Install dependencies
RUN \
    cd /tmp \
    && apk add \
    su-exec \
    && \
    docker-php-ext-install $PHP_EXTENSIONS

# pm.max_children = 90
ADD ./www.conf /usr/local/etc/php-fpm.d/www.conf

# tweak custom php-fpm config
ADD ./php.ini /usr/local/etc/php/conf.d/05-php.ini


# Build dependencies.
ENV BUILD_DEPS \
    autoconf \
    g++ \
    make


RUN \
	#
	# helper packages
	apk add \
        nano \
        wget \
        git \
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


ENV LANG=ru_RU.UTF-8 \
    LANGUAGE=ru_RU.UTF-8 \
    LC_LANG=ru_RU.UTF-8 \
    LC_ALL=ru_RU.UTF-8


RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

# Configure XDebug.
COPY xdebug.ini /usr/local/etc/php/conf.d/20-xdebug.ini


WORKDIR /var/www
