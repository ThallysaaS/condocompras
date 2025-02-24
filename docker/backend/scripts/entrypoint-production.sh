#!/bin/sh
php artisan tenants:migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
docker-php-entrypoint php-fpm
