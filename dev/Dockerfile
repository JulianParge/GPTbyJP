FROM php:8.0-apache

# update, upgrade, and clean
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# copy source and php.ini
COPY ./source /var/www
COPY ./dev/php.ini /usr/local/etc/php

# enable mod rewrite
RUN a2enmod rewrite && \
    chown -R www-data:www-data /var/www

WORKDIR /var/www

ENTRYPOINT ["apache2-foreground"]