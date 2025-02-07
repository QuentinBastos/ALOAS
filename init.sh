#!/bin/bash

# Exit on error
set -e

# Log start
echo "🔄 Initializing Environment..."

if [ "$APP_ENV" = "prod" ]; then
  # Wait for MySQL to be available
  echo "⏳ Waiting for MySQL to be available at $DB_HOST..."
  until mysql -h "$DB_HOST" -u "$DB_USER" -p "$DB_PASS" -e "SELECT 1" &>/dev/null; do
    echo "🚫 MySQL is unavailable - retrying..."
    sleep 3
  done

  echo "✅ MySQL is available!"

  # Ensure the database exists (skip if using OVH)
  echo "🔹 Using database: $DB_NAME"

  # Wait to ensure DB is fully ready
  sleep 5

  # Run migrations
  echo "⚙️ Running database migrations..."
  php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

  echo "🚀 Production Initialization Complete!"
else
  # Wait for MySQL to be available
  until mysql -h db -u root -e "SELECT 1"; do
    >&2 echo "MySQL is unavailable - sleeping"
    sleep 1
  done

  # Create the database if it doesn't exist
  mysql -h db -u root -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

  # Log the DB name to ensure it's correct
  echo "Using database: $DB_NAME"

  # Wait to ensure DB is fully ready
  sleep 5

  # Run migrations
  echo "⚙️ Running database migrations..."
  php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

  echo "🚀 Initialization Complete!"
fi
