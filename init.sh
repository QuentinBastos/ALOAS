#!/bin/bash

# Wait for MySQL to be available
until mysql -h db -u root -e "SELECT 1"; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

# Create the database if it doesn't exist
mysql -h db -u root -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

# Log the DB name to ensure it's correct
echo "Using database: $MYSQL_DATABASE"

# Wait for a few seconds to ensure DB is ready
sleep 5

# Run migrations
cd /var/www || exit
php bin/console doctrine:migrations:migrate --no-interaction