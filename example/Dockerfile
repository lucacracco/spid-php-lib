ARG PHP_IMAGE_TAG=8.0-apache

FROM php:${PHP_IMAGE_TAG}

RUN apt-get update && \
    apt-get -y --no-install-recommends install \
      libcurl4-openssl-dev \
      libzip-dev \
      libxml2-dev \
      zip \
      curl \
      wget \
      nano && \
    docker-php-ext-install curl zip && \
    pecl install channel://pecl.php.net/xmlrpc-1.0.0RC3 xmlrpc && \
    docker-php-ext-enable xmlrpc && \
    pecl clear-cach && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*;

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/example

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    a2enmod rewrite

WORKDIR "/var/www/html"
