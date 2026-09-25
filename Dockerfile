FROM dunglas/frankenphp:php8.4

ENV SERVER_NAME=":80"

WORKDIR /app

RUN apt-get update && apt-get install -y \
    supervisor \
    unzip \
    git \
    postgresql-client \
    libxrender1 \
    libxext6 \
    libfontconfig1 \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    mbstring \
    intl \
    pcntl \
    bcmath \
    exif \
    gd \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan storage:link || true

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
