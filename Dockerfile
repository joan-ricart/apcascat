ARG APP_ENV=local

# --- Stage 1: Composer Dependencies ---
FROM composer:2.7 as vendor

WORKDIR /app

COPY composer.json composer.lock ./

# Conditionally install dev dependencies
RUN if [ "$APP_ENV" = "local" ]; then \
    composer install \
        --no-interaction \
        --no-scripts \
        --no-progress \
        --prefer-dist \
        --ignore-platform-reqs; \
elif [ "$APP_ENV" = "production" ]; then \
    composer install \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --no-progress \
        --prefer-dist \
        --ignore-platform-reqs; \
fi


# --- Stage 2: Node.js Frontend Build ---
FROM node:20-alpine as node_builder

WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json package-lock.json ./

# Install npm dependencies and build assets
RUN npm install && npm run build


# --- Stage 3: Final Application Image ---
FROM dunglas/frankenphp:1-php8.4

# Install required PHP extensions
RUN install-php-extensions \
	pdo_pgsql \
	gd \
	intl \
	zip \
	opcache \
    bcmath \
    exif \
    redis

WORKDIR /app

# Copy the application code
COPY . .

# Copy Composer dependencies from the vendor stage
COPY --from=vendor /app/vendor ./vendor/

# Copy frontend assets from the node_builder stage
# For local dev, the host mount will override this /app/public/build directory.
COPY --from=node_builder /app/public/build ./public/build

# Set correct permissions for Laravel to be able to write to storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Set the server name and expose the port
ENV SERVER_NAME=":80"