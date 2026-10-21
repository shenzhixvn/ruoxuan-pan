FROM php:7.0-apache

# php:7.0-apache 基于 Debian stretch（已 EOL），先把 apt 源切到 archive 再装 gd 依赖
RUN sed -i 's|deb.debian.org|archive.debian.org|g; s|security.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i '/stretch-updates/d' /etc/apt/sources.list \
 && apt-get -o Acquire::Check-Valid-Until=false update \
 && apt-get install -y --allow-unauthenticated --no-install-recommends libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install pdo_mysql mysqli exif gd \
 && a2enmod rewrite

COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
