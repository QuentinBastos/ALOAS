#!/bin/bash

# Exit on error
set -e

echo "🔄 Starting initialization..."

# Wait for PostgreSQL to be available
echo "⏳ Checking PostgreSQL connection..."
until PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -d "$POSTGRES_DB" -c "SELECT 1" &>/dev/null; do
    >&2 echo "🔄 PostgreSQL is unavailable - sleeping"
    sleep 3
done

echo "✅ PostgreSQL is available!"

# Run migrations
echo "⚡ Running database migrations..."
cd /var/www/html || exit
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
echo "✅ Migrations complete!"

echo "🎉 Initialization complete!"
