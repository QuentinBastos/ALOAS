#!/bin/bash

# Exit on error
set -e

echo "🔄 Starting initialization..."

# Wait for PostgreSQL to be available
echo "⏳ Checking PostgreSQL connection..."
until PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -c "SELECT 1" &>/dev/null; do
    >&2 echo "🔄 PostgreSQL is unavailable - sleeping"
    sleep 3
done

echo "✅ PostgreSQL is available!"

# Create the database if it doesn't exist
echo "🔧 Setting up database..."
PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -tc "SELECT 1 FROM pg_database WHERE datname = '$POSTGRES_DB'" | grep -q 1 || \
PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -c "CREATE DATABASE \"$POSTGRES_DB\""
echo "✅ Database setup complete!"

# Run migrations
echo "⚡ Running database migrations..."
cd /var/www/html || exit
php bin/console doctrine:migrations:migrate --no-interaction
echo "✅ Migrations complete!"

echo "🎉 Initialization complete!"