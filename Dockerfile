FROM php:7.2-apache

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

#RUN ln -s
#COPY src/ /var/www/html
RUN a2ensite camagru.com.conf

RUN a2enmod rewrite