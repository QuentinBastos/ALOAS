#!/bin/bash

set -e

echo "Waiting for database connection..."
until mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "SELECT 1"; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 2
done

echo "Creating database if it doesn't exist..."
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

echo "Running migrations..."
cd /var/www/html
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "Clearing cache..."
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod