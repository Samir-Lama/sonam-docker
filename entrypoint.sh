#!/bin/bash
composer update
if grep -q "APP_KEY=" .env; then
  php artisan key:generate
fi

php artisan migrate:fresh --seed

exec "$@"