FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libfreetype-dev \ 
    libjpeg62-turbo-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*
    
RUN docker-php-ext-install zip pdo_mysql bcmath pgsql pdo_pgsql mysqli pcntl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]
