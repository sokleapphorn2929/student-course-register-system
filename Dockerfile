FROM php:8.4-fpm-bookworm

# ... (keep all your existing installation commands) ...

# Copy all application files
COPY . .

# Install dependencies WITHOUT any scripts
RUN COMPOSER_MEMORY_LIMIT=-1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# ⭐ ADD THIS - Generate application key during build
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

EXPOSE 10000

# ⭐ MODIFY THIS - Remove the key generation from CMD
CMD php artisan serve --host=0.0.0.0 --port=10000