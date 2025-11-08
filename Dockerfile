# Dockerfile (php-fpm)
FROM php:8.2-fpm

# -------------------------------
# Install system dependencies & PHP extensions
# -------------------------------
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql mbstring bcmath sockets exif pcntl gd \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# -------------------------------
# Install Composer
# -------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# -------------------------------
# Set working directory
# -------------------------------
WORKDIR /var/www/html

# -------------------------------
# Copy all project files
# -------------------------------
COPY . .

# -------------------------------
# Create storage/cache dirs & set permissions
# -------------------------------
RUN mkdir -p storage/framework storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# -------------------------------
# Expose PHP-FPM port
# -------------------------------
EXPOSE 9000

# -------------------------------
# Match www-data UID/GID with host (avoid permission issues)
# -------------------------------
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# -------------------------------
# Run as non-root user
# -------------------------------
USER www-data

# -------------------------------
# Default command: php-fpm
# -------------------------------
CMD ["php-fpm"]
