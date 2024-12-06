FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libpng-dev \
  libzip-dev \
  default-mysql-client \
  nano \
  dos2unix \
  curl

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

RUN docker-php-ext-install pdo pdo_mysql zip gd

RUN a2enmod rewrite

COPY config/apache/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader

RUN chown -R www-data:www-data /var/www/var /var/www/public && \
    chmod -R 775 /var/www/var /var/www/public

COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh

COPY init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

RUN npm run build

RUN dos2unix /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh

# Expose port 80
EXPOSE 80

RUN sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]