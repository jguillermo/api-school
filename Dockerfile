FROM php:7.4.15-fpm-alpine
WORKDIR /app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev rabbitmq-c rabbitmq-c-dev bash \
    && pecl install amqp-1.9.4 \
    && pecl install apcu-5.1.17 \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        intl \
        pdo_mysql \
    && docker-php-ext-enable \
        amqp \
        apcu \
        opcache

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY container/etc/infrastructure/php/ /usr/local/etc/php/
