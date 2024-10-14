# Use the official PHP image as the base
FROM php:8.3-fpm

# Install system dependencies and Git
RUN apt-get update && apt-get install -y \
    git \
    openssh-client \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Expose the port used by PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
