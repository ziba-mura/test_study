FROM php:8.2-fpm

# 必要パッケージと拡張
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev && \
    docker-php-ext-install pdo pdo_mysql zip

# Xdebugインストール
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
