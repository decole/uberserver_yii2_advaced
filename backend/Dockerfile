FROM yiisoftware/yii2-php:7.2-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/backend/web|g' /etc/apache2/sites-available/000-default.conf

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
RUN echo "extension=mosquitto.so" > /usr/local/etc/php/php.ini
# #RUN rm -rf /tmp/pear ~/.pearrc
# RUN echo "extension=mosquitto.so" > /etc/php7/conf.d/30_mosquitto.ini

# RUN echo "expose_php=0" > /usr/local/etc/php/php.ini
# RUN echo "extension=mosquitto.so" > /usr/local/etc/php/php.ini
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \аш
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
    && docker-php-ext-install sockets \
    && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached