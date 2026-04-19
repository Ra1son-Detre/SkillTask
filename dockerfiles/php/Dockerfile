FROM php:8.2-fpm-alpine

WORKDIR /var/www/skiltask


RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    oniguruma-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    bcmath \
    exif \
    pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


