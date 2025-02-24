#!/bin/sh
php artisan tenants:migrate-fresh --tenants=app-staging.utilis.com.br
php artisan tenants:seed --tenants=app-staging.utilis.com.br --force
php artisan tenants:migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
docker-php-entrypoint php-fpm
