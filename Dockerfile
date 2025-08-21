FROM php:8.4-fpm-alpine

ENV APP_ENV=dev
ENV APP_DEBUG=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install system dependencies
RUN apk update && apk add --no-cache \
    git curl zip unzip openldap-dev freetype-dev libjpeg-turbo-dev \
    libpng-dev pkgconfig oniguruma-dev icu-dev bash

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo_mysql mbstring intl gd opcache

# Install composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls --version=2.7.2 \
   && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/
COPY . .

RUN chown -R 33:33 /var/www/html