#!/bin/bash

until mysql -h db -u root -e "SELECT 1"; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

mysql -h db -u root -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

cd /var/www

if [ -d "migrations" ]; then
  php bin/console doctrine:migrations:migrate --no-interaction
else
  php bin/console doctrine:database:create
  echo "Migrations directory does not exist. Skipping migrations."
fi