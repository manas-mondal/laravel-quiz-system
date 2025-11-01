# Dockerfile (php-fpm)
FROM php:8.2-fpm

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql mbstring bcmath sockets exif pcntl gd \
  && apt-get clean && rm -rf /var/lib/apt/lists/*


# Bring Composer binary from official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install PHP dependencies (skip artisan scripts to avoid build-time error)
RUN composer install --no-interaction --prefer-dist --no-scripts

# Create storage/cache dirs & set permissions
RUN mkdir -p storage/framework storage/logs bootstrap/cache \
  && chown -R www-data:www-data storage bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

# Match www-data UID/GID with host (avoid permission issues in bind mounts)
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Run as non-root user (fixes file permission issues)
USER www-data

# CMD
CMD ["php-fpm"]
