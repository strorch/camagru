FROM php:7.2-apache

WORKDIR /app

#install pdo extention
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

#install and configure xdebug extention
RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini

#GD lib install
RUN apt-get update \
    && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

#install smtp client
#TODO: config mailing mail('homiak.max@gmail.com', 'Subject', 'Body');
#RUN apt-get update && apt-get install msmtp -y && \
#    rm -rf /var/lib/apt/lists/*
#COPY config/msmtprc /etc/msmtprc
#RUN echo "sendmail_path = /usr/bin/msmtp -t -i" >> /usr/local/etc/php/php.ini

#apache config
RUN rm /etc/apache2/sites-available/000-default.conf
COPY config/camagru.com.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir /var/www/camagru.com
RUN ln -s /app /var/www/camagru.com/public_html

RUN rm /etc/apache2/ports.conf
COPY config/ports.conf /etc/apache2/ports.conf

RUN a2enmod rewrite
