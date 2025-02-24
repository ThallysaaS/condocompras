#!/bin/sh
php artisan migrate:fresh --seed --env=app-staging --path=database/migrations/central
php artisan migrate:fresh:tenant --env=app-staging
php artisan config:cache
php artisan route:cache
php artisan view:cache
docker-php-entrypoint php-fpm
