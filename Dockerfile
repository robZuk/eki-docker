FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev curl nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

# Instalacja Node.js i npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Kopiowanie kodu aplikacji
COPY ./src /var/www/html

# Instalacja zależności PHP
RUN composer install --no-dev --optimize-autoloader

# Instalacja zależności Node.js i build
RUN npm ci --verbose
RUN npm run build --verbose

# Kopiowanie konfiguracji Nginx
COPY ./nginx/default.conf /etc/nginx/sites-available/default

# Ustawienie uprawnień
RUN chown -R www-data:www-data /var/www/html

# Expose port 10000 (Render wymaga)
EXPOSE 10000

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
