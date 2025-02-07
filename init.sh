#!/bin/bash

# Exit on error
set -e

# Log start
echo "🔄 Initializing Environment..."

# Extract PostgreSQL credentials from environment
echo "🔹 Database Host: $DB_HOST"
echo "🔹 Database User: $DB_USER"
echo "🔹 Database Name: $DB_NAME"

# Wait for PostgreSQL to be available with timeout
echo "⏳ Waiting for PostgreSQL to be available at $DB_HOST..."
TIMEOUT=300  # 5 minutes timeout
ELAPSED=0
SLEEP_TIME=5

until PGPASSWORD="$DB_PASS" psql -h "$DB_HOST" -U "$DB_USER" -d "$DB_NAME" -c "SELECT 1" &>/dev/null; do
    if [ $ELAPSED -ge $TIMEOUT ]; then
        echo "❌ Timeout waiting for PostgreSQL connection"
        exit 1
    fi
    echo "🚫 PostgreSQL is unavailable - retrying in ${SLEEP_TIME} seconds..."
    sleep $SLEEP_TIME
    ELAPSED=$((ELAPSED + SLEEP_TIME))
done

echo "✅ PostgreSQL is available!"

# Run migrations
echo "⚙️ Running database migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "🚀 Production Initialization Complete!"