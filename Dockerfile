# Use official PHP + Apache image
FROM php:8.1-apache

# Install required PHP extensions if needed (like mbstring, pdo, etc.)
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite (optional, only if you use .htaccess)
RUN a2enmod rewrite

# Copy all files to Apache’s web root
COPY . /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
