#!/bin/bash

# Włącz debugowanie Laravel
export APP_DEBUG=true

# Przejdź do katalogu aplikacji
cd /var/www/html

# Wyczyść cache Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm

# Keep container running
tail -f /dev/null
