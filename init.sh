#!/bin/bash

# Exit on error
set -e

# Log start
echo "🔄 Initializing Environment..."

# Extract MySQL credentials from DATABASE_URL
echo "🔹 Database Host: $DB_HOST"
echo "🔹 Database User: $DB_USER"
echo "🔹 Database Name: $DB_NAME"

# Wait for MySQL to be available with timeout
echo "⏳ Waiting for MySQL to be available at $DB_HOST..."
TIMEOUT=300  # 5 minutes timeout
ELAPSED=0
SLEEP_TIME=5

until mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "SELECT 1" &>/dev/null; do
    if [ $ELAPSED -ge $TIMEOUT ]; then
        echo "❌ Timeout waiting for MySQL connection"
        exit 1
    fi
    echo "🚫 MySQL is unavailable - retrying in ${SLEEP_TIME} seconds..."
    sleep $SLEEP_TIME
    ELAPSED=$((ELAPSED + SLEEP_TIME))
done

echo "✅ MySQL is available!"

# Run migrations
echo "⚙️ Running database migrations..."
php /var/www/html/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "🚀 Production Initialization Complete!"