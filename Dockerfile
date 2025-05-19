# Dockerfile para PHP 8.4-FPM con mysqli instalado
FROM php:8.4-fpm

# Instalar las dependencias necesarias para compilar mysqli
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       libzip-dev \
       zip \
       unzip \
       libonig-dev \
       libxml2-dev \
       libpng-dev \
       libjpeg-dev \
       libfreetype6-dev \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Deja el directorio de trabajo
WORKDIR /var/www/html

# (Opcional) Copia composer.json y composer.lock si vas a usar Composer:
# COPY composer.json composer.lock /var/www/html/
# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#     && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
#     && rm composer-setup.php

# Montaje de tu código se hace desde docker-compose.yml
