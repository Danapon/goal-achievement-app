FROM php:8.1-fpm-buster
COPY ./src /var/www
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

RUN apt update \
  && apt install -y zlib1g-dev mariadb-client vim libzip-dev unzip\
  && docker-php-ext-install zip pdo_mysql

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

RUN echo 'alias la="ls -la"' >> ~/.bashrc
RUN echo 'alias ll="ls -la"' >> ~/.bashrc
RUN echo 'alias rm="rm -i"' >> ~/.bashrc
RUN echo 'alias cp="cp -i"' >> ~/.bashrc
RUN echo 'alias mv="mv -i"' >> ~/.bashrc

# tinker(psysh)
ARG PSYSH_DIR=/usr/local/share/psysh
ARG PSYSH_PHP_MANUAL=$PSYSH_DIR/php_manual.sqlite
ARG PHP_MANUAL_URL=http://psysh.org/manual/ja/php_manual.sqlite

# timezone
ARG TZ=Asia/Tokyo

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

WORKDIR /var/www