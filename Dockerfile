FROM php:5.6
RUN pecl install xdebug && docker-php-ext-enable xdebug
WORKDIR /app
