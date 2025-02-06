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
  curl && \
  apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

RUN npm install -g npm

RUN docker-php-ext-install pdo pdo_mysql zip gd

WORKDIR /var/www/html

COPY package.json package-lock.json ./

RUN npm install

COPY . /var/www/html

RUN rm -rf /var/www/html/vendor

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader

RUN npm run build

# Set correct permissions for /var/www/html
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html

COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
COPY init.sh /usr/local/bin/init.sh

RUN chmod +x /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh && \
    dos2unix /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .htaccess /var/www/html/public/.htaccess

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]