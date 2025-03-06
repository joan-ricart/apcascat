# Use the official FrankenPHP image
FROM docker.io/dunglas/frankenphp:1.4-php8.4-alpine

# Set working directory to where your Laravel app will be
WORKDIR /app

# Copy your Laravel project files into the container
COPY . .

RUN install-php-extensions \
	gd \
	intl \
	zip \
	opcache \
    pdo_mysql \
    sodium \
    zip \
    bcmath \
    exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
RUN npm install