# Dockerfile
FROM php:8.3-fpm

# Paquetes y extensiones necesarias (pgsql)
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev libicu-dev pkg-config \
 && docker-php-ext-install mbstring exif pcntl bcmath gd zip intl \
 && docker-php-ext-install pdo_pgsql

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Dependencias PHP (prod)
RUN composer install --no-dev --optimize-autoloader

# Permisos de Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 3000
CMD ["php", "-S", "0.0.0.0:3000", "-t", "public"]
