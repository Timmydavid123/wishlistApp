# Use an official PHP runtime with FPM
FROM php:8.3-fpm

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    curl zip unzip git libpng-dev libonig-dev libjpeg-dev libfreetype6-dev nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory in the container
WORKDIR /var/www

# Copy application files into the container
COPY . .

# Set permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy Nginx configuration
COPY ./nginx.conf /etc/nginx/nginx.conf

# Expose port 80 to the Render platform
EXPOSE 80

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm
