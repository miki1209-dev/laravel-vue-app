FROM php:8.2-cli

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql zip

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# CMDではなくdocker-composeでcommand指定するのでここはなし
