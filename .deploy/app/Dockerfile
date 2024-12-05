FROM php:8.1-fpm

WORKDIR "/app"

ARG DOCKER_GID
ARG DOCKER_UID

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# настройка пользователя и прав
RUN groupadd -g $DOCKER_GID docker
RUN useradd -g $DOCKER_GID -u $DOCKER_UID -m docker

# установка необходимых пакетов
# faketime - для удобства тестирования логики завязанной на время
RUN apt-get update \
    && apt-get install -y \
        libmcrypt-dev \
        libzip-dev \
        libpq-dev \
        git \
        libicu-dev \
        faketime \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# установка php расширений
RUN docker-php-ext-install bcmath exif pcntl zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl

RUN docker-php-ext-install -j$(nproc) pdo_pgsql

COPY .deploy/app/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini

USER docker

COPY --chown=docker:docker .deploy/app/docker-entrypoint.sh /docker-entrypoint.sh

ENTRYPOINT /docker-entrypoint.sh
