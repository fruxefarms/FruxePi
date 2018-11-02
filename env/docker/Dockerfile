FROM php:7.1-apache-jessie

# Install Dependencies

RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev cron nano && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install mbstring && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/  &&  \
    docker-php-ext-install gd

# Configure Apache

RUN a2enmod rewrite

ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80

# Restart

RUN service apache2 restart