FROM php:8.2 as php

RUN apt-get update -y \
    && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . .

COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT [ "docker/entrypoint.sh" ]