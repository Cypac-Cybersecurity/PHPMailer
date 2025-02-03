# Use lightweight Alpine Linux with PHP
FROM php:8.2-fpm-alpine

# Install required dependencies
RUN apk add --no-cache \
    bash \
    ca-certificates \
    curl \
    tar \
    unzip \
    tzdata \
    supervisor \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Install PHPMailer
RUN composer require phpmailer/phpmailer

# Copy PHP mail script (sendmail.php)
COPY sendmail.php /var/www/html/sendmail.php

# Ensure PHP-FPM runs perpetually
CMD ["php-fpm", "-F"]
