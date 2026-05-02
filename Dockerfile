# Usamos una imagen oficial de PHP con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema y el driver de PostgreSQL
# libpq-dev es necesario para que PHP pueda comunicarse con Supabase
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# 2. Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# 3. Instalar Composer directamente desde su imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configurar el directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar archivos de dependencias y ejecutar instalación
# Usamos --no-dev para un entorno de producción más ligero
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 6. Copiar el resto del código del proyecto
COPY . .

# 7. Ajustar permisos para que el servidor web pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html

# 8. Render usa el puerto 80 por defecto para servicios web
EXPOSE 80