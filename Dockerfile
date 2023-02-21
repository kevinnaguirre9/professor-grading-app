FROM php:8.1-fpm-alpine3.17

RUN apk add --no-cache gcc g++ autoconf make pkgconfig git openssl \
    libressl curl-dev zip unzip supervisor nginx bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Nginx and PHP default configuration files.
COPY ./etc/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./etc/php/fpm-pool.conf /etc/php81/php-fpm.d/www.conf
COPY ./etc/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /run/nginx \
    && chown -R www-data:www-data /run/nginx \
    && mkdir -p /run/supervisord/log \
    && chown -R www-data:www-data /run/supervisord

WORKDIR /app

COPY . .

# run composer install to install the dependencies
RUN composer install --prefer-dist --optimize-autoloader --no-dev \
    && php artisan doctrine:custom-types:map \
    && php artisan doctrine:xml-documents:map

RUN chmod -R 775 storage \
    && chown -R www-data:www-data storage

EXPOSE 8080

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
