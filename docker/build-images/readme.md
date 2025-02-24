# Utilis

<!-- @import "[TOC]" {cmd="toc" depthFrom=1 depthTo=6 orderedList=false} -->

<!-- code_chunk_output -->

-   [QUALIFICAES](#utilis)
    -   [Setup step by step](#setup)
    -   [Requirements](#requirements)
    -   [Installation](#installation)
    -   [Additional Configurations](#additional-configurations)
        -   [PHPSTORM](#phpstorm)
        -   [IDE Helper](#ide-helper)
-   [Docker](#docker)

<!-- /code_chunk_output -->

## Setup

-   [Environment Configuration - Part 1 - PT_BR ](https://www.loom.com/share/66d242dd5cd64d06b91c20165c0d94e6)
-   [Environment Configuration - Part 2 - PT_BR ](https://www.loom.com/share/b432befece4c44efb1b90885693e9496)

## Requirements

-   Postgresql client (installed locally) - https://www.postgresql.org/download/
    -   There's no need to install the server, only the CLI client (psql, pgdump)
        -   You can choose to install only the client during installation
-   PHP 8.2
    -   Windows: https://windows.php.net/downloads/releases/archives/
    -   Latest 8.2.x NTS - 64 Bits - https://windows.php.net/downloads/releases/archives/php-8.2.20-nts-Win32-vs16-x64.zip
    -   Or you can use docker
    -   Extensions:
        -   bcmath
        -   ctype
        -   curl
        -   fileinfo
        -   json
        -   mbstring
        -   exif
        -   openssl
        -   pdo
        -   tokenizer
        -   xml
        -   zip
        -   gd
        -   php-redis
            -   https://pecl.php.net/package/redis
        -   xdebug (optional) - url for download: https://xdebug.org/wizard.php
-   Composer for php dependencies (https://getcomposer.org/download/)
-   Nodejs 20 or higher
    -   You can download nvm for windows on https://github.com/coreybutler/nvm-windows
-   Docker
    -   [Windows + WSL2]
        -   https://docs.docker.com/desktop/windows/wsl/
        -   https://www.docker.com/products/docker-desktop/
-   In docker-compose.yml is bundled:
    -   Postgresql
    -   Redis
    -   Mailhog

## Installation

0. Install Dependencies (PHP and Nodejs 20+) for backend and frontend:
    - `composer install`
    - `npm install`
1. Copy the file .env.example in root to a file named .env
    - `cp .env.example .env`
2. Generate application key
    - `php artisan key:generate`
3. Initialize docker
    - `docker compose up -d`
4. Create needed databases on postgresql
    - qualificaes (used for local development)
    - qualificaes_testing (used for testing)
5. Migrate and seed central and tenant apps
    - Local:
        - `php artisan migrate:fresh --seed`
    - Testing:
        - `php artisan migrate:fresh --seed --env=testing`
6. Start Frontend :
    - `npm run dev`
7. Start the app:
    - `php artisan serve`
8. Access the App:
    - urls
        - app (frontend): http://dev.utilis.localhost
        - app (api): http://api.utilis.localhost
        - mailhog: http://mailhog.localhost
        - redis-commander: http://redis.localhost
    - login: `admin@admin.com` / password: `password`

## Additional Configurations

### PHPSTORM

This document illustrates how to configure other aspects of the project for easier maintenance and development (eg:
Eslint, prettier, etc).

Read how to configure PHP STORM [Here](./docs/configuring-phpstorm.md) or access the readme (
./docs/configuring-phpstorm.md)

### IDE Helper

This project uses [Laravel Ide Helper](https://github.com/barryvdh/laravel-ide-helper) to create docblocks to help in
the autocomplete of the project.

After full installation of the project, you can use the command `` composer `update-ide-helper `` to generate the model
and metadata that is saved in a git ignored file in the root of the project.

Some of these commands run automatically too after a composer install / update, but to generate models data you can run
these commands to update those informations
