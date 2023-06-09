#!/bin/bash
composer install

if [ ! -f ".env" ]; then
  cp .env.example .env
fi

php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan storage:link
chmod 777 -R bootstrap
chmod 777 -R storage
exec "$@"