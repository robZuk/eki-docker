#!/bin/bash

# Włącz debugowanie Laravel
export APP_DEBUG=true

# Przejdź do katalogu aplikacji
cd /var/www/html

# Napraw uprawnienia do folderów storage
chown -R www-data:www-data storage
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Uruchom migracje Laravel (jeśli baza jest dostępna)
php artisan migrate --force || echo "Migracje nie mogły zostać uruchomione"

# Wyczyść cache Laravel (tylko jeśli tabele istnieją)
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Wygeneruj komponenty Blade Icons
php artisan icons:cache

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm

# Keep container running
tail -f /dev/null
