#!/bin/bash

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm

# Keep container running
tail -f /dev/null
