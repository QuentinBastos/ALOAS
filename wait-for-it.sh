#!/usr/bin/env bash

set -e

host="$1"
shift
cmd="$@"

until pg_isready -h "$host"; do
  >&2 echo "PostgreSQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "PostgreSQL is up - executing command"
exec $cmd