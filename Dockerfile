# Use the official PHP image from Docker Hub
FROM php:8.1-apache

# Enable Apache mod_rewrite (if needed)
RUN a2enmod rewrite

# Install any additional PHP extensions (e.g., PDO, MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Copy the application files into the container
COPY . /var/www/html/

# Set permissions (optional but often required)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default for Apache)
EXPOSE 80

# Set the entry point (Apache will run by default)
CMD ["apache2-foreground"]
