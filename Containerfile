# Use the official FrankenPHP image
FROM docker.io/dunglas/frankenphp:1.4-php8.4-alpine

# Set working directory to where your Laravel app will be
WORKDIR /app

# Copy your Laravel project files into the container
COPY . .

RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache
