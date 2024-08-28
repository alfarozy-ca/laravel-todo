# Gunakan image resmi PHP dengan ekstensi yang dibutuhkan
FROM php:8.1-fpm

# Set working directory di dalam container
WORKDIR /var/www

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin file composer.json dan composer.lock untuk dependency caching
COPY composer.json composer.lock ./

# Install dependency PHP menggunakan Composer
RUN composer install --no-scripts --no-autoloader --prefer-dist --optimize-autoloader --no-dev

# Salin seluruh project ke dalam container
COPY . .

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Ubah permission folder storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port yang akan digunakan
EXPOSE 9000

# Perintah untuk menjalankan PHP-FPM
CMD ["php-fpm"]
