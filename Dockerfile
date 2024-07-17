FROM dunglas/frankenphp

RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache \
    pcntl \
    bcmath \
    redis \
    sockets \
    zstd

COPY . /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN composer install

ENV OCTANE_SERVER="frankenphp"

RUN php artisan octane:install --server=frankenphp

EXPOSE 8000

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
