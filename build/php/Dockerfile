FROM composer as composer
COPY ./app/ /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:7.2.7-fpm-alpine3.7
RUN apk update && apk upgrade;
RUN docker-php-ext-install pdo_mysql
RUN mkdir /run/php
ADD ./build/php/conf/www.conf /etc/php/7.2.7/fpm/pool.d/www.conf
ADD ./build/php/conf/php-fpm.conf /etc/php/7.2.7/fpm/php-fpm.conf
WORKDIR /var/www/html/
COPY ./app/ /var/www/html/
COPY --from=composer /app/vendor/ /var/www/html/vendor/
RUN ln -snf /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime
# Symfony3
# RUN PATH=$PATH:/var/www/html/vendor/bin:bin
# RUN cp /var/www/html/app/config/config_dev.yml.dist /var/www/html/app/config/config_dev.yml
# RUN cp /var/www/html/app/config/parameters.yml.dist /var/www/html/app/config/parameters.yml
# RUN chmod +x bin/console
EXPOSE 9000