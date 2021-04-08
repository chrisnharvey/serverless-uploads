FROM composer AS composer

FROM php:8.0-apache-buster
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . /app
WORKDIR /app

ADD docker/php.ini $PHP_INI_DIR/conf.d/
ADD docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -qq git unzip libpng-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql bcmath && \
    composer install --optimize-autoloader --no-dev && \
    php artisan view:cache && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    a2enmod rewrite & \
    chown www-data:www-data -R /app/storage