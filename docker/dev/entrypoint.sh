#!/bin/sh

cd /var/www/backend || exit 1
composer install

php artisan key:generate
php artisan storage:link
php artisan migrate

npm install

php artisan serve --host=0.0.0.0 --port=8000
npm run dev