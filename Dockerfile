FROM php:8.3-apache

RUN docker-php-ext-install mysqli

COPY app/ /var/www/html/

CMD ["apache2-foreground"]

