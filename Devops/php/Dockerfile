FROM php:8.0.3-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    zip \
    nano \
    git \
    libzip4 \
    libzip-dev \
    && apt-get -yqq update \
    && apt-get -yqq install libxml2-dev \
    && docker-php-ext-install xml \
    && docker-php-ext-install zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

RUN chown -hR www-data /var/www \
 && usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

WORKDIR /var/www/RestFullApi/Api

USER "${USER_ID}:${GROUP_ID}"
