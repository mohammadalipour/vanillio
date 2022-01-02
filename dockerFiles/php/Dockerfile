FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN sed -i 's/9000/9002/' /usr/local/etc/php-fpm.d/zz-docker.conf
WORKDIR /var/www/app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "md.alipour91@gamil.com" \
    && git config --global user.name "Mohammad Alipour"

EXPOSE 9002
CMD ["php-fpm"]