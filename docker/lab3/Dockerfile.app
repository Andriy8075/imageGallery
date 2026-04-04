# Stage 1: Node builder
FROM node:18-alpine AS node-build
WORKDIR /app
COPY package*.json ./
RUN npm install && npm cache clean --force
COPY . .
RUN npm run build && rm -rf node_modules

# Stage 2: Composer builder
FROM php:8.2-cli-alpine AS php-deps
RUN apk add --no-cache git unzip
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.* ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# Stage 3: Final image
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    bash \
    vim \
    curl \
    git \
    lsof \
    procps \
    tree \
    && rm -rf /var/cache/apk/*

RUN apk add --no-cache \
    libpng \
    oniguruma \
    libxml2 \
    mariadb-client \
    libzip

RUN apk add --no-cache --virtual .build-deps \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    autoconf \
    g++ \
    make && \
    docker-php-ext-install \
    pdo_mysql \
    mbstring \
    gd \
    zip && \
apk del .build-deps

WORKDIR /var/www

COPY --from=php-deps /app/vendor ./vendor
COPY --from=node-build /app/public/build ./public/build
COPY . .

# Create storage directory structure and set permissions
RUN mkdir -p storage/app/public \
    storage/framework/{cache,sessions,testing,views} \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Create symbolic link
RUN php artisan storage:link

EXPOSE 8000

ENV DB_CONNECTION=mysql \
    DB_HOST=mysqldb \
    DB_PORT=3306 \
    DB_DATABASE=laravel \
    DB_USERNAME=laravel \
    DB_PASSWORD=secret

RUN chmod +x docker/lab3/entrypoint.sh

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
