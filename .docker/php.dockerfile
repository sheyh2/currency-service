FROM php:8.2-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN mkdir -p /var/www

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN delgroup dialout

RUN addgroup -g ${GID} --system currenct
RUN adduser -G currenct --system -D -s /bin/sh -u ${UID} currenct

RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf


RUN apk add --no-cache \
    curl \
    libxml2-dev \
    php-soap \
    libzip-dev \
    unzip \
    zip \
    libpng \
    libpng-dev \
    jpeg-dev \
    oniguruma-dev \
    curl-dev \
    freetype-dev \
    libpq-dev

RUN docker-php-ext-install pgsql pdo pdo_pgsql mbstring exif zip soap pcntl bcmath curl zip opcache

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

USER currenct

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
