#!/bin/bash
set -e

echo "🔄 Starting initialization..."

echo "⏳ Checking PostgreSQL connection..."
until PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -d "$DB_NAME" -c "SELECT 1" &>/dev/null; do
    >&2 echo "🔄 PostgreSQL is unavailable - sleeping"
    sleep 3
done

echo "✅ PostgreSQL is available!"

echo "Using database: $DB_NAME"

sleep 5

php /var/www/html/bin/console doctrine:schema:drop --force

echo "⚙️ Running database migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || {
    echo "❌ Migration failed. Retrying in 5 seconds..."
    sleep 5
    php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
}

echo "✅ Migrations applied successfully!"

exec "$@"