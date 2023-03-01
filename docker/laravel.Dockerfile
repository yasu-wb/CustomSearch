FROM php:8.2-fpm

# Debian packages
RUN apt-get update && apt-get install -y \
    autoconf \
    bash \
    build-essential \
    curl \
    g++ \
    git \
    libxml2-dev \
    make \
    openssl \
    unzip \
    zip \
    zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions (Non-standard)
RUN pecl install xdebug && docker-php-ext-enable xdebug

# PHP extensions (Standard)
RUN docker-php-ext-install opcache pdo_mysql

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && \
    apt-get install -y nodejs

# npm
RUN npm install -g npm@latest

RUN rm -rf /var/cache/apk/*

WORKDIR /usr/share/nginx/html
