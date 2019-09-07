FROM php:7.2-apache

WORKDIR /app

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

RUN rm /etc/apache2/sites-available/000-default.conf

COPY config/camagru.com.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir /var/www/camagru.com

RUN ln -s /app /var/www/camagru.com/public_html

RUN rm /etc/apache2/ports.conf

COPY config/ports.conf /etc/apache2/ports.conf

RUN a2enmod rewrite
