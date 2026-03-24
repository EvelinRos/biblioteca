FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Activar mod_rewrite
RUN a2enmod rewrite

# Copiar configuración de Apache (opcional)
COPY apache.conf /etc/apache2/sites-available/000-default.conf