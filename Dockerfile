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

RUN composer install

ENV OCTANE_SERVER="frankenphp"

RUN php artisan octane:install --server=frankenphp

EXPOSE 8000

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
