cd /var/www || exit 1
php artisan key:generate
php artisan storage:link

echo "Waiting for database..."
until php artisan db:monitor; do
  echo "Database is unavailable - sleeping"
  sleep 2
done

echo "Running migrations..."
php artisan migrate || exit 1

php artisan serve --host=0.0.0.0 --port=8000