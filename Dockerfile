FROM php:8.4-apache

RUN docker-php-ext-install mysqli

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

# Set environment variable for Apache
RUN echo 'SetEnv DB_HOST ${DB_HOST}' > /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_USER ${DB_USER}' > /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_PASS ${DB_PASS}' > /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv DB_NAME ${DB_NAME}' > /etc/apache2/conf-enabled/environment.conf

EXPOSE 80
