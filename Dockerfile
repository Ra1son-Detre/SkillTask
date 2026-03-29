FROM php:8.2-fpm

# Установка системных зависимостей для Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


# Установка Composer
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Устанавливаем рабочую деррикторию
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем весь проект в контейнер
COPY . /var/www

# Создаем пользователя www-data и даем ему права на storage и cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Порт который слушает PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
