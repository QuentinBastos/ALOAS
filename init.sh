#!/bin/bash

set -e

echo "🔄 Starting initialization..."

echo "⏳ Checking MySQL connection..."
until mysql -h db -u root -e "SELECT 1"; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 3
done


mysql -h db -u root -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;"

cd /var/www
php bin/console doctrine:migrations:migrate --no-interaction
echo "✅ Migrations complete!"
echo "🎉 Initialization complete!"