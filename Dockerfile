FROM php:8.4-fpm-bookworm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install MongoDB extension via PECL (works with PHP 8.4)
RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . .

# Create .env file with CORRECT configuration for MongoDB Atlas
RUN echo "APP_NAME=StudentCourseRegister" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_DEBUG=true" >> .env && \
    echo "APP_URL=https://student-course-register-system.onrender.com" >> .env && \
    echo "" >> .env && \
    echo "# Database Configuration" >> .env && \
    echo "DB_CONNECTION=mongodb" >> .env && \
    echo "DB_URI=mongodb+srv://sokleap111:LVj7iwcyCNxyDE2z@cluster0.64ynazr.mongodb.net/student-course?retryWrites=true&w=majority&appName=Cluster0" >> .env && \
    echo "DB_DATABASE=student-course" >> .env && \
    echo "" >> .env && \
    echo "# Session & Cache" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "CACHE_STORE=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "BROADCAST_DRIVER=log" >> .env

# Install dependencies
RUN COMPOSER_MEMORY_LIMIT=-1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Generate key only (don't cache config during build)
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000