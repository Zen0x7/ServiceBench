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

RUN apt-get update && apt-get install -y gnupg2

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y yarn

COPY . /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN composer install

RUN yarn install

ENV OCTANE_SERVER="frankenphp"

RUN php artisan octane:install --server=frankenphp

EXPOSE 8000

ENTRYPOINT ["/app/startup.sh"]
