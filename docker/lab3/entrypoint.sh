cd /var/www || exit 1
if [ ! -f .env ]; then cp docker/lab3/.env.example .env; fi
php artisan key:generate
php artisan storage:link
php artisan migrate --force