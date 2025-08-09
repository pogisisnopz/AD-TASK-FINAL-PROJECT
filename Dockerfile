# Use official PHP 8.3 Alpine image with FPM
FROM php:8.3.21-fpm-alpine3.20

# Switch to root user for administrative tasks
USER root

# Set environment variable for development
ENV NODE_ENV=development

# Install necessary system dependencies, including bash, PostgreSQL client, and MongoDB dependencies
RUN apk add --no-cache \
    git \
    unzip \
    autoconf \
    make \
    g++ \
    icu-dev \
    libzip-dev \
    zlib-dev \
    postgresql-dev \
    libpq \
    bash \
    postgresql-client \
    nano \
    && apk add --no-cache --virtual .build-deps \
    libxml2-dev \
    && pecl install mongodb \
    && docker-php-ext-install pgsql pdo_pgsql intl zip \
    && docker-php-ext-enable pgsql pdo_pgsql mongodb \
    && apk del .build-deps  # Clean up unnecessary build dependencies

# Create a non-root user for better security
RUN addgroup -S developer && adduser -S yourUsernameHere -G developer

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files into the working directory
COPY . /var/www/html/

# Switch back to the non-root user for better security
USER yourUsernameHere

# Expose port 80 for the PHP server
EXPOSE 80

# Install PHP dependencies using Composer
RUN composer install --no-dev --prefer-dist

# Start the PHP built-in web server using router.php
CMD ["php", "-S", "0.0.0.0:80", "router.php"]