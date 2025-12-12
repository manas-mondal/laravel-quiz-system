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
# Copy project
# ----------------------------------------------------------
COPY . .

# ----------------------------------------------------------
# Install Dependencies
# ----------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts \
    && mkdir -p storage/framework storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# ----------------------------------------------------------
# Ensure Dev Providers Are Removed From Autoload (VERY IMPORTANT)
# ----------------------------------------------------------
RUN composer dump-autoload --no-dev

 # ----------------------------------------------------------
 # Fix Laravel storage framework structure
 # ----------------------------------------------------------
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
 && chmod -R 777 storage \
 && chmod -R 777 bootstrap/cache


# ----------------------------------------------------------
# Copy Nginx + Supervisor configuration
# ----------------------------------------------------------
COPY docker/prod/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY docker/prod/supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Remove default nginx site
RUN rm -f /etc/nginx/sites-enabled/default

# ----------------------------------------------------------
# Expose port
# ----------------------------------------------------------
EXPOSE 80

# ----------------------------------------------------------
# Start Supervisord
# ----------------------------------------------------------
CMD ["/usr/bin/supervisord"]
