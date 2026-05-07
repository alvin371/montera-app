#!/bin/sh
set -eu

cd /var/www/html

if [ ! -f .env ]; then
    echo "Missing /var/www/html/.env. Create it before starting Docker." >&2
    exit 1
fi

: "${PHP_MEMORY_LIMIT:=512M}"

cat > /usr/local/etc/php/conf.d/zz-montera.ini <<EOF
memory_limit=${PHP_MEMORY_LIMIT}
EOF

mkdir -p application/cache/sessions application/logs
chown -R www-data:www-data application/cache application/logs
chmod -R 775 application/cache application/logs

exec "$@"
