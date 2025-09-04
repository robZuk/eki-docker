#!/bin/bash

# Włącz debugowanie Laravel
export APP_DEBUG=true

# Przejdź do katalogu aplikacji
cd /var/www/html

# Wyczyść cache Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Wygeneruj komponenty Blade Icons
php artisan icons:cache

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm

# Keep container running
tail -f /dev/null
