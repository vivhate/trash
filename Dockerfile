FROM php:apache
COPY src/ /var/www/html/
RUN docker-php-ext-install pdo pdo_mysql mysqli
EXPOSE 80
