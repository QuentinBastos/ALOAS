#!/bin/bash

# Exit on error
set -e

echo "🔄 Starting initialization..."

# Wait for MySQL to be available
echo "⏳ Checking MySQL connection..."
until mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "SELECT 1" &>/dev/null; do
    >&2 echo "🔄 MySQL is unavailable - sleeping"
    sleep 3
done

echo "✅ MySQL is available!"

# Create the database if it doesn't exist
echo "🔧 Setting up database..."
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"
echo "✅ Database setup complete!"

# Run migrations
echo "⚡ Running database migrations..."
cd /var/www/html || exit
php bin/console doctrine:migrations:migrate --no-interaction
echo "✅ Migrations complete!"

echo "🎉 Initialization complete!"