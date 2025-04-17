# todo add variable to image
# If you need to rebuild this repository image, check /docker/build-images/backend.Dockerfile
# gcp repository
#FROM us-east1-docker.pkg.dev/utilis-217318/utilis-spa/utilis-spa-php:7.4-fpm as php-fpm
# dockerhub
FROM 471112993938.dkr.ecr.sa-east-1.amazonaws.com/saes-dahu-base-image:latest as php-fpm

COPY composer.json .
COPY composer.lock .

ARG USER=app
ARG APP_ENV=production
RUN export APP_ENV=$APP_ENV

RUN composer install --no-interaction --no-dev --no-scripts --no-autoloader --ignore-platform-reqs --no-plugins

COPY . .

RUN mv .env.pipelines .env && \
    composer dumpautoload --no-dev --optimize

USER root

# setting up permissions
RUN chown -R $USER:www-data ./ && \
    find . -type f -exec chmod 664 {} \; && \
    find . -type d -exec chmod 775 {} \; && \
    chgrp -R www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

USER $USER
