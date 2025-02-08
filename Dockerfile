# ------------------  NODE STAGE  ------------------
FROM node:20 AS node-builder

WORKDIR /app

# Copy package.json & lock file first to cache dependencies
COPY package.json package-lock.json ./

# Install dependencies
RUN npm ci

# Copy assets and build them
COPY assets/ ./assets/
COPY webpack.config.js ./

RUN npm run build

# ------------------  PHP STAGE  ------------------
FROM php:8.3-apache

# Install required system dependencies
RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libpng-dev \
  libzip-dev \
  default-mysql-client \
  dos2unix \
  curl \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy PHP project files
COPY . /var/www/html

# Remove existing vendor directory before installing dependencies
RUN rm -rf vendor

# Install PHP dependencies (without dev dependencies for production)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader

# Copy built assets from Node.js stage
COPY --from=node-builder /app/public/build public/build

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html

# Copy Apache & initialization files
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
COPY init.sh /usr/local/bin/init.sh

RUN chmod +x /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh && \
    dos2unix /usr/local/bin/wait-for-it.sh /usr/local/bin/init.sh

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]

