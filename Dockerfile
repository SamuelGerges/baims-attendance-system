FROM php:8.2 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev git
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev

RUN docker-php-ext-install gd


RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && apt-get install -y libicu-dev \
    && docker-php-ext-enable redis \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable gd

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
#ENTRYPOINT [ "docker/entrypoint.sh" ]
#RUN ["chmod", "+x", "docker/entrypoint.sh"]

# Installing Node
SHELL ["/bin/bash", "--login", "-i", "-c"]
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash
RUN source /root/.bashrc && nvm install 20
SHELL ["/bin/bash", "--login", "-c"]

RUN npm install -g yarn
