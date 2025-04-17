# Imagem base para o backend (PHP-FPM)
FROM php:8.2-fpm as php-fpm

# Variáveis de ambiente e argumentos
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0
ENV PHP_OPCACHE_REVALIDATE_FREQ=0

ARG user=app
ARG uid=1000

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    postgresql-client \
    nginx \
    libnss3 libnspr4 libatk1.0-0 libatk-bridge2.0-0 libcups2 libdrm2 libxkbcommon0 \
    libxcomposite1 libxdamage1 libxfixes3 libxrandr2 libgbm1 libasound2 libcairo2 \
    libpango-1.0-0

# Instalar extensões do PHP
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Instalar Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Criar usuário e diretórios
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer /home/$user/.nvm /home/$user/app_node_modules && \
    chown -R $user:$user /home/$user && \
    rm -rf /var/www/html

# Instalar o NVM e Node.js
ENV NODE_VERSION=16.15.1
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
ENV NVM_DIR=/home/$user/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="${NVM_DIR}/versions/node/v${NODE_VERSION}/bin/:${PATH}"

# Instalar o Wrangler e Puppeteer
RUN npm install -g wrangler puppeteer@21.0.3

# Copiar o composer do contêiner do Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Diretório de trabalho para o backend
WORKDIR /var/www

# Instalar dependências do Composer para o backend
COPY composer.json .
COPY composer.lock .
RUN composer install --no-interaction --no-dev --no-scripts --no-autoloader --ignore-platform-reqs --no-plugins

# Copiar o código-fonte do backend
COPY . .

# Configurar permissões
USER root
RUN chown -R $user:www-data ./ && \
    find . -type f -exec chmod 664 {} \; && \
    find . -type d -exec chmod 775 {} \; && \
    chgrp -R www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

USER $user

# Instalar dependências do frontend (Node.js)
FROM node:16.15.1-alpine as node

WORKDIR /app

# Instalar as dependências do frontend (exemplo)
COPY package.json package-lock.json ./
RUN npm install

# Copiar o código-fonte do frontend
COPY . .

# Rodar o build do frontend
RUN npm run build

# Finalizar com a imagem do backend (PHP)
FROM php-fpm

# Copiar os arquivos de build do frontend para o diretório público do backend (se necessário)
COPY --from=node /app/dist /var/www/public

# Finalizar
USER $user
