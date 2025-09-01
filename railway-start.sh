#!/bin/bash

# Uruchom migracje (opcjonalnie)
php artisan migrate --force

# Wyczyść cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Uruchom PHP-FPM
php-fpm
