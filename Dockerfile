# Main image
FROM php:7.2-fpm
# Author
MAINTAINER decole <decole@rambler.ru>

# Update and install modules for php and other
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && apt-get install -y wget zip unzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install git
RUN apt-get install -y git

# Install phpunit
RUN wget https://phar.phpunit.de/phpunit-6.5.phar && \
        chmod +x phpunit-6.5.phar && \
        mv phpunit-6.5.phar /usr/local/bin/phpunit


# Install codecept
RUN wget http://codeception.com/codecept.phar && \
        chmod +x codecept.phar && \
        mv codecept.phar /usr/local/bin/codecept

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

# #RUN rm -rf /tmp/pear ~/.pearrc
# RUN echo "extension=mosquitto.so" > /etc/php7/conf.d/30_mosquitto.ini

# RUN echo "expose_php=0" > /usr/local/etc/php/php.ini
# RUN echo "extension=mosquitto.so" > /usr/local/etc/php/php.ini
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
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
    && docker-php-ext-install wddx \
    && :\
    && apt-get install -y libbz2-dev \
    && docker-php-ext-install bz2 \
    && :\
    && docker-php-ext-install zip \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install exif \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install calendar \
    && docker-php-ext-install sockets
    # \
#    && apt-get install -y libmemcached-dev zlib1g-dev \
#    && pecl install memcached \
#    && docker-php-ext-enable memcached

# Add custom php.ini
# ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Copy app
RUN mkdir /var/www/project
COPY www/project/ /var/www/project/

# Workdir for php
WORKDIR /var/www/project

# Run container
# The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]