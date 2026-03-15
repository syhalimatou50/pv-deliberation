FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Create startup script
RUN echo '#!/bin/bash\nphp artisan migrate --force\nphp artisan serve --host=0.0.0.0 --port=8080' > /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

# Start with migrations
CMD ["/start.sh"]
