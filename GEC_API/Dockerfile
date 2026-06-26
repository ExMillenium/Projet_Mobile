FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app
COPY . /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "index.php"]
