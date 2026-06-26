FROM php:8.2-cli

# Extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le code
WORKDIR /app
COPY . /app

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port Render
EXPOSE 10000

# Lancer ton API depuis index.php à la racine
CMD ["php", "-S", "0.0.0.0:10000", "index.php"]
