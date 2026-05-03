FROM php:8.2-apache

# 1. Instalar dependencias del sistema, PHP pgsql Y NODE.JS
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 2. Instalar dependencias de PHP
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 3. Instalar dependencias de NODE (Bootstrap, etc.)
COPY package.json package-lock.json* ./
RUN npm install

# 4. Copiar el resto del proyecto
COPY . .

RUN chown -R www-data:www-data /var/www/html
EXPOSE 80