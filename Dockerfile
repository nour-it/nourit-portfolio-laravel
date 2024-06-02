FROM php:8.2-fpm
# FROM debian:latest

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y zip wget unzip curl git vim

# PHP
RUN apt-get install -y \
    libfreetype-dev \ 
    libjpeg62-turbo-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    lsb-release 

RUN docker-php-ext-install pdo_mysql bcmath pgsql pdo_pgsql mysqli

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x > setup.x 
RUN chmod +x setup.x
RUN ./setup.x
RUN apt-get update && apt-get install -y nodejs
RUN npm install -g yarn 

# mysql
RUN wget https://dev.mysql.com/get/mysql-apt-config_0.8.24-1_all.deb
RUN dpkg -i mysql-apt-config_0.8.24-1_all.deb
RUN ls -lah
RUN apt-get update && apt-get install -y mysql-server
# Set environment variables for MySQL
ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=my_database
ENV MYSQL_USER=my_user
ENV MYSQL_PASSWORD=my_password


# mail
RUN npm install -g maildev

COPY . /var/www
WORKDIR /var/www

# start
RUN mv ".env.example" ".env"

RUN echo "composer install --optimize-autoloader" > start.sh
RUN echo "yarn" >> start.sh
RUN echo "maildev &" >> start.sh
RUN echo "php artisan serve --host=0.0.0.0 --port=80" >> start.sh

RUN chmod +x start.sh

EXPOSE 3306
EXPOSE 80
EXPOSE 1080

CMD ["sh", "-c", "./start.sh" ]