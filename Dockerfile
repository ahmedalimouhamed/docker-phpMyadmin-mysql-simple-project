FROM php:7.4-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Change ownership of /var/www/html directory
RUN chown -R www-data:www-data /var/www/html

COPY . /var/www/html/
EXPOSE 80