ARG COMPOSER_VERSION=2.5.4
ARG UNIT_VERSION=1.29.1-php8.1
ARG PHP_VERSION=8.1-cli

FROM composer:${COMPOSER_VERSION} as composer_builder

WORKDIR /deps

COPY composer.json .
COPY composer.lock .

RUN composer install --optimize-autoloader --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts

FROM scratch as base

WORKDIR /app

COPY . .
COPY --from=composer_builder /deps/vendor vendor

FROM nginx/unit:${UNIT_VERSION} as api

ARG USER=backend
ARG GROUP=backend

RUN groupadd --gid 1000 ${GROUP} && \
    useradd --uid 1000 --gid ${GROUP} --shell /bin/bash --create-home ${USER}

ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /app

# TODO: Change public folder permissions
COPY --from=base --chown=${USER}:${GROUP} --chmod=777 /app .

COPY --from=base /app/config.json /docker-entrypoint.d/config.json
COPY --from=base /app/php.ini /etc/php.ini

RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pgsql pdo_pgsql opcache && \
    apt-get --purge -y remove gcc make && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 80
