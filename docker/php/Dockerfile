FROM php:8.0-fpm-alpine

RUN docker-php-ext-install  pdo pdo_mysql

WORKDIR /var/www/html

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --enable-gd \
    --with-jpeg=/usr/include/ \
    --with-freetype=/usr/include/  && \
  NPROC=$(getconf _NPROCESSORS_ONLN) && \
  docker-php-ext-install -j${NPROC} gd && \
  apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

RUN apk add --no-cache libzip-dev && docker-php-ext-install zip
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pcov-1.0.9 mysqli sockets

RUN docker-php-ext-enable pcov gd mysqli sockets

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . /var/www/html

