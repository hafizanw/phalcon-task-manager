# ==========================================
# Stage 1 - Build Phalcon
# ==========================================
FROM php:8.2-fpm-bookworm AS builder

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpcre3-dev \
    libzip-dev \
    libssl-dev \
    gcc \
    make \
    autoconf \
    pkg-config \
    re2c \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
    && pecl channel-update pecl.php.net \
    && pecl install phalcon-5.9.3 \
    && docker-php-ext-enable phalcon \
    && rm -rf /tmp/pear \
    && rm -rf /var/lib/apt/lists/*


# ==========================================
# Stage 2 - Runtime
# ==========================================
FROM php:8.2-fpm-bookworm

WORKDIR /var/www

RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip4 \
    libssl3 \
    && rm -rf /var/lib/apt/lists/*

# Copy PHP extensions dari builder
COPY --from=builder /usr/local/lib/php/extensions/ \
    /usr/local/lib/php/extensions/

# Copy konfigurasi extension
COPY --from=builder /usr/local/etc/php/conf.d/ \
    /usr/local/etc/php/conf.d/

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]