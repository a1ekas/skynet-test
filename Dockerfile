ARG from

FROM ${from}

# Install pcov extension
RUN apk update \
    && apk add --no-cache --update \
    linux-headers \
    $PHPIZE_DEPS \
    && docker-php-ext-install opcache \
    && pecl install pcov \
    && docker-php-ext-enable pcov

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY config /app/config
COPY public /app/public
COPY src /app/src

WORKDIR /app

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
