# ----------------------------------------------------------
# Base image: PHP 8.2 with FPM
# ----------------------------------------------------------
FROM php:8.2-fpm

# ----------------------------------------------------------
# Install system dependencies including Nginx + Supervisor
# ----------------------------------------------------------
RUN apt-get update && apt-get install -y \
    nginx supervisor git curl zip unzip \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring bcmath sockets exif pcntl gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ----------------------------------------------------------
# Install Composer globally
# ----------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ----------------------------------------------------------
# Working directory
# ----------------------------------------------------------
WORKDIR /var/www/html

# ----------------------------------------------------------
# Copy project files
# ----------------------------------------------------------
COPY . .

# ----------------------------------------------------------
# Install PHP dependencies for production
# ----------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ----------------------------------------------------------
# Fix permissions for Laravel
# ----------------------------------------------------------
RUN mkdir -p storage/framework storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# ----------------------------------------------------------
# Copy Nginx config
# ----------------------------------------------------------
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# ----------------------------------------------------------
# Copy Supervisord config
# ----------------------------------------------------------
COPY docker/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# ----------------------------------------------------------
# Expose port 80 (Nginx)
# ----------------------------------------------------------
EXPOSE 80

# ----------------------------------------------------------
# Start Supervisord (runs Nginx + PHP-FPM)
# ----------------------------------------------------------
CMD ["/usr/bin/supervisord"]
