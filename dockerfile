# Usamos una imagen base con Apache y PHP preinstalados
FROM php:8.1-apache

# Copiamos el contenido de la aplicación al directorio raíz del servidor web de Apache
COPY . /var/www/html

# Damos permisos adecuados para los archivos en el directorio de Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilitamos módulos de Apache si es necesario (por ejemplo, mod_rewrite)
RUN a2enmod rewrite

# Exponemos el puerto 80 para que el contenedor acepte conexiones HTTP
EXPOSE 80

# Configuramos el comando por defecto para iniciar Apache
CMD ["apache2-foreground"]
