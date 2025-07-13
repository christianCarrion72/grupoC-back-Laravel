# Usa la imagen oficial de PHP 8.2 con FPM como base
FROM php:8.2-fpm

# Instala herramientas y dependencias del sistema necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Copia Composer desde la imagen oficial de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define la carpeta de trabajo dentro del contenedor
WORKDIR /var/www

# Copia todos los archivos del proyecto al contenedor
COPY . .

# Instala las dependencias de Laravel, excluyendo las de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Crea un archivo .env vacío (necesario para ejecutar comandos de Laravel)
# Asigna permisos a los directorios requeridos y genera la key de aplicación
RUN touch .env && \
    chmod -R 775 storage bootstrap/cache && \
    php artisan key:generate

# realizar comandos (en local) de forma manual después del despliegue usando las mismas variables del .env de producccion :
# php artisan migrate --force
# php artisan db:seed --force

# Expone el puerto 8000 para que Render pueda acceder a la app
EXPOSE 8000

# Comando que inicia el servidor Laravel cuando el contenedor arranca
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
