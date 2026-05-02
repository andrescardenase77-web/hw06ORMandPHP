# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# 2. Instalar y habilitar la extensión pdo_pgsql que usa tu connection.php
RUN docker-php-ext-install pdo_pgsql

# 3. Habilitar el módulo rewrite de Apache (por si usas rutas amigables)
RUN a2enmod rewrite

# 4. Instalar Composer globalmente en el contenedor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Establecer el directorio de trabajo
WORKDIR /var/www/html

# 6. Copiar los archivos de configuración de dependencias primero
COPY composer.json composer.lock ./

# Cambia la línea 7 de tu Dockerfile por esta:
RUN composer install --no-interaction --optimize-autoloader --no-dev && composer dump-autoload -o

# 8. Copiar el resto del código del proyecto
COPY . .

# 9. Ajustar permisos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html

# 10. Exponer el puerto 80
EXPOSE 80

# El comando por defecto ya arranca Apache, así que no necesitamos CMD