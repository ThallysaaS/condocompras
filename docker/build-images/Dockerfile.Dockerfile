# Imagem base PHP com suporte a FPM
FROM php:8.2-fpm

# Instalar dependências do sistema e Node.js
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar Node.js e NPM
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Instalar o Wrangler CLI
RUN npm install -g wrangler

# Instalar Puppeteer
RUN npm install --location=global puppeteer@21.0.3

# Instalar extensões PHP necessárias
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Instalar Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Criar usuário e diretórios necessários
ARG user=app
ARG uid=1000
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    mkdir -p /home/$user/.nvm && \
    mkdir -p /home/$user/app_node_modules && \
    chown -R $user:$user /home/$user && \
    rm -rf /var/www/html

USER $user

# Instalar NVM (Node Version Manager)
ENV NODE_VERSION=16.15.1
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
ENV NVM_DIR=/home/$user/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="${NVM_DIR}/versions/node/v${NODE_VERSION}/bin/:${PATH}"

# Instalar Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www
