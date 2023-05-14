FROM php:8.1-fpm

COPY ./src /var/www
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /var/www/entrypoint.sh
# RUN composer install
# RUN php artisan key:generate
ENTRYPOINT ["./entrypoint.sh"]

CMD ["php-fpm", "-F"]
EXPOSE 9000

