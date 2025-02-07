#!/bin/bash

# Exit on error
set -e

# Log start
echo "🔄 Initializing Environment..."

# Extract MySQL credentials from DATABASE_URL
echo "🔹 Database Host: $DB_HOST"
echo "🔹 Database User: $DB_USER"
echo "🔹 Database Name: $DB_NAME"

# Wait for MySQL to be available
echo "⏳ Waiting for MySQL to be available at $DB_HOST..."
until mysql -h "$DB_HOST" -u "$DB_USER" -p "$DB_PASS" -e "SELECT 1" &>/dev/null; do
  echo "🚫 MySQL is unavailable - retrying..."
  sleep 3
done

echo "✅ MySQL is available!"

# Skip database creation (OVH already has it)
echo "🔹 Using database: $DB_NAME"

# Wait to ensure DB is fully ready
sleep 5

# Run migrations
echo "⚙️ Running database migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "🚀 Production Initialization Complete!"
