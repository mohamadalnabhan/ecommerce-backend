FROM php:8.1-apache

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your code
COPY . /var/www/html

# Set correct ownership
RUN chown -R www-data:www-data /var/www/html
