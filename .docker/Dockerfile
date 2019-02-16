FROM php:7.1.8-apache
RUN docker-php-ext-install pdo_mysql

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite
