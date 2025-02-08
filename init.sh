#!/bin/bash

# Wait for MySQL to be available
until mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "SELECT 1"; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

# Create the database if it doesn't exist
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

cd /var/www || exit
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction