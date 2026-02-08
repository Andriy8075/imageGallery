#!/bin/sh

cd /var/www || exit 1
composer install

if [ ! -f .env ]; then
  cp .env.example .env
fi

php artisan key:generate
php artisan storage:link
php artisan migrate

npm install

php artisan serve --host=0.0.0.0 --port=8000
npm run dev
