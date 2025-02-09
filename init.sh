#!/bin/bash

set -e

echo "🔄 Starting initialization..."

# Wait for PostgreSQL to be available
echo "⏳ Checking PostgreSQL connection..."
until PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -d "$DB_NAME" -c "SELECT 1" &>/dev/null; do
    >&2 echo "🔄 PostgreSQL is unavailable - sleeping"
    sleep 3
done

echo "✅ PostgreSQL is available!"

# Generate migrations if needed
echo "⚡ Generating PostgreSQL migrations..."
php bin/console doctrine:migrations:diff || echo "No new migrations needed."

# Run migrations
echo "⚡ Running database migrations..."
php bin/console doctrine:migrations:migrate --no-interaction

echo "✅ Migrations complete!"
echo "🎉 Initialization complete!"
