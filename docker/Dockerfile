FROM php:8.1.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libxslt-dev  \
    zip \
    unzip \
    openssl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql mbstring exif pcntl bcmath gd intl curl xsl

# Get latest Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Create system user to run Composer and Artisan Commands
RUN groupadd -g 1000 --system www
RUN useradd -u 1000 -ms /bin/bash -g www -G www-data,root,www --system www
RUN chown -R www:www /var/www/

COPY ../ /var/www

USER root

EXPOSE 9000

CMD ["php-fpm"]

