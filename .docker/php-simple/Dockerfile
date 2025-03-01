FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx supervisor

RUN docker-php-ext-install -j$(nproc) \
   pdo_mysql mysqli

WORKDIR /app

COPY nginx.conf /etc/nginx/http.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

RUN mkdir -p /run/nginx

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
