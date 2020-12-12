FROM php:7.4-fpm

MAINTAINER decole <decole@rambler.ru>

# mysqldump
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    && rm -rf /var/lib/apt
#RUN apt-get update && apt-get install -y --no-install-recommends mysql-client && rm -rf /var/lib/apt

# Tools
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        apt-transport-https \
        wget \
        ssh \
        git \
        nano \
        locales \
        zip \
        unzip

# Install dependency
RUN buildDeps=" \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        libmcrypt-dev \
        libxml2-dev \
        libxslt1-dev \
        libssl-dev \
        libmagick++-dev \
        libonig-dev \
        libpq-dev \
        libssh2-1-dev \
        libzip-dev \
    " \
    && apt-get install -y --no-install-recommends $buildDeps

# Composer
RUN curl -sS "https://getcomposer.org/installer" | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require "codeception/codeception=*" "codeception/specify=*" "codeception/verify=*" \
    && composer global dumpautoload --optimize \
    && composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# php-redis
ENV PHPREDIS_VERSION 4.2.0

RUN docker-php-source extract \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && docker-php-source delete

# apcu
RUN docker-php-source extract \
    && apt update \
    && pecl install apcu \
    && docker-php-ext-enable apcu

# Install via pecl Mosquitto MQTT Extension for PHP
RUN apt install mosquitto-dev libmosquitto-dev libmosquitto1 -y
RUN pecl update-channels
RUN pecl install Mosquitto-alpha
RUN echo "extension=mosquitto.so" > /usr/local/etc/php/conf.d/30_mosquitto.ini

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-install gd \
    && :\
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl \
    && :\
    && apt-get install -y libxml2-dev \
    && apt-get install -y libxslt-dev \
    && docker-php-ext-install soap \
    && docker-php-ext-install xsl \
    && docker-php-ext-install xmlrpc \
    && :\
    && apt-get install -y libbz2-dev \
    && docker-php-ext-install bz2 \
    && :\
    && docker-php-ext-install pcntl \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install exif \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install calendar \
    && docker-php-ext-install xml \
    && docker-php-ext-install xmlwriter \
    && docker-php-ext-install simplexml \
    && docker-php-ext-install json \
    && docker-php-ext-install iconv \
    && docker-php-ext-install fileinfo \
    && docker-php-ext-install dom \
    && docker-php-ext-install sockets\
    && docker-php-ext-configure zip \
            --with-zip \
    && docker-php-ext-install zip

# Install supervisor
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    supervisor
COPY images/worker/supervisor/supervisord.conf /etc/supervisor

# Copy app
RUN mkdir /var/www/project
COPY www/project/ /var/www/project/

# Clear
RUN rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/cache/apk/* \
    && docker-php-source delete \
    && apt-get purge -y $buildDeps

# Workdir for php
WORKDIR /var/www/project

# Configs, etc
COPY images/php/php.ini /usr/local/etc/php/conf.d/custom.ini
RUN mkdir /var/log/php7


RUN mkfifo /tmp/stdout && chmod 777 /tmp/stdout

# Run container
CMD ["php-fpm"]