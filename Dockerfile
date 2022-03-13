FROM php:8.1-fpm

RUN docker-php-ext-install bcmath pdo_mysql

RUN apt-get update
RUN apt-get install -y git zip unzip

USER www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN chmod -r 755 /var/www/storage/logs
EXPOSE 9000
