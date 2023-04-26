FROM php:8.1-apache
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN apt-get update && apt-get install -y unzip
RUN docker-php-ext-install pdo_mysql
RUN composer require symfony/apache-pack
RUN composer require --dev symfony/phpunit-bridge
RUN composer require --dev phpunit/phpunit
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html