#!/bin/bash
set -e

echo "🔄 Starting initialization..."

echo "⚙️ Running database migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || {
    echo "❌ Migration failed. Retrying in 5 seconds..."
    sleep 5
    php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
}

echo "✅ Migrations applied successfully!"

exec "$@"