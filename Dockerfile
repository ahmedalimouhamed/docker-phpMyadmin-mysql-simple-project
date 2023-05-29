FROM php:7.4-apache

# Install PHP MySQL extension
RUN docker-php-ext-install mysqli

# Copiez les fichiers de votre projet dans le conteneur
COPY . /var/www/html

# Définissez le répertoire de travail
WORKDIR /var/www/html

# Exposez le port 80 pour accéder à votre application depuis l'extérieur
EXPOSE 80

# Démarrez le serveur Apache et exécutez votre application PHP
CMD ["php", "-S", "0.0.0.0:80"]