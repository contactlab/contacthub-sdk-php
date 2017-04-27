FROM php:5.6
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo 'date.timezone = "Europe/Rome"' > /usr/local/etc/php/php.ini
WORKDIR /app
