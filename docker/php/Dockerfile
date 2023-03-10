FROM php:8.1-fpm-bullseye AS base

WORKDIR /workdir

ENV TZ=${TIMEZONE} LANG=en_US.UTF-8 LANGUAGE=en_US:en LC_ALL=en_US.UTF-8 COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_HOME=/composer

COPY --from=composer:2.5.1  /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get -qq update && apt-get -qq -y install --no-install-recommends locales git unzip nmap nodejs build-essential \
    libzip-dev libicu-dev libonig-dev libpng-dev libldap2-dev libxml2 libxml2-dev libcurl4-openssl-dev libreadline-dev \
    libkrb5-dev libc-client-dev libpq-dev libsqlite3-dev zlib1g-dev vim nano
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
RUN locale-gen en_US.UTF-8 && localedef -f UTF-8 -i en_US en_US.UTF-8
RUN docker-php-ext-configure opcache --enable-opcache && docker-php-ext-install -j$(nproc) opcache
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install -j$(nproc) imap
RUN docker-php-ext-configure intl && docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql pdo_sqlite zip bcmath gd ldap soap curl mbstring xml
RUN composer config -g process-timeout 3600 && composer config -g repos.packagist composer https://packagist.org

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./docker/php/php.deploy-override.ini /usr/local/etc/php/conf.d/

COPY . /workdir

RUN composer install --quiet --no-interaction  --no-ansi --no-scripts --no-progress --optimize-autoloader --prefer-dist
RUN npm install --quiet --no-progress
RUN npm run build --quiet --no-progress

RUN mkdir -p /workdir/storage
RUN mkdir -p /workdir/storage/logs

RUN chown -R www-data:www-data /workdir/bootstrap/cache
RUN chown -R www-data:www-data /workdir/storage
RUN chown -R www-data:www-data /workdir/storage/logs