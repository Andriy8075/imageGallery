cd /var/www || exit 1
if [ ! -f .env ]; then cp docker/prod/.env.example .env; fi
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000