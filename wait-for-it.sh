#!/usr/bin/env bash

set -e

host="$1"
shift
cmd="$@"

until mysqladmin ping -h "$host" -u "$DB_USER" -p"$DB_PASS" --silent; do
    >&2 echo "🔄 MySQL is unavailable - sleeping"
    sleep 3
done

>&2 echo "✅ MySQL is up - executing command"
exec $cmd