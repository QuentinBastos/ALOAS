FROM node:16 AS build

WORKDIR /var/www

COPY package.json package-lock.json ./

RUN npm install --save-dev @symfony/webpack-encore

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

COPY apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

COPY . /var/www
RUN rm -rf /var/www/vendor

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader

COPY vendor /var/www/vendor

COPY --from=build /var/www/node_modules ./node_modules

RUN chown -R www-data:www-data /var/www/var /var/www/public && \
    chmod -R 775 /var/www/var /var/www/public

ENV PATH=/var/www/node_modules/.bin:$PATH

RUN npm run build

COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh

COPY init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

RUN dos2unix /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh

EXPOSE 80

RUN sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]