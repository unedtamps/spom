FROM php:8.2-fpm-alpine

# Install dependencies


RUN apk update && \
  apk add --no-cache \
  libzip \
  libpng \
  oniguruma-dev \
  libpng-dev \
  curl \
  nmap \
  bash


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring  pcntl bcmath gd

## Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /spom

COPY . .

## Install the composer dependencies
RUN composer install

## expose port
EXPOSE 1323

CMD ["bash", "-c", "while ! nc -z ${DB_HOST} ${DB_PORT}; do sleep 1; done && php artisan migrate:refresh --seed && php artisan serve --port=8080 --host=0.0.0.0"]
