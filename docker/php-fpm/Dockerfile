ARG VERSION

# Dev image
FROM php:${VERSION}-fpm-alpine AS dev

## Install system dependencies
RUN apk update && \
    apk add --no-cache --virtual dev-deps git autoconf gcc g++ make && \
    apk add --no-cache zlib-dev libzip-dev

## Install php extensions
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql zip

RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --with-gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} gd && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

## Copy php default configuration
COPY ./docker/php-fpm/default.ini /usr/local/etc/php/conf.d/default.ini

ENV APP_ENV=dev
WORKDIR /app

## Install composer
RUN wget https://getcomposer.org/installer && \
    php installer --install-dir=/usr/local/bin/ --filename=composer && \
    rm installer && \
    composer global require hirak/prestissimo

# Test image
FROM dev AS test

WORKDIR /app

## Copy project files to workdir
COPY . .

## Install application dependencies
RUN composer install --no-interaction --optimize-autoloader

## Change files owner to php-fpm default user
RUN chown -R www-data:www-data .

# Prod image
FROM test AS prod

ENV APP_ENV=prod
WORKDIR /app

## Remove dev dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

## Disable xdebug on production
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

## Cleanup
RUN apk del dev-deps && \
    composer global remove hirak/prestissimo && \
    rm /usr/local/bin/composer

