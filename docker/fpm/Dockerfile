FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        && apt-get install -y libpq-dev \
        && apt-get install -y git \
        && apt-get install -y libcurl4-openssl-dev\
        && apt-get install -y pkg-config \
        && docker-php-ext-install pcntl \
        && docker-php-ext-install exif \
        && docker-php-ext-install opcache \
        && docker-php-ext-install pdo pdo_mysql

ENV PHALCON_VERSION=3.4.0

RUN curl -sSL "https://codeload.github.com/phalcon/cphalcon/tar.gz/v${PHALCON_VERSION}" | tar -xz \
    && cd cphalcon-${PHALCON_VERSION}/build \
    && ./install \
    && cp ../tests/_ci/phalcon.ini $(php-config --configure-options | grep -o "with-config-file-scan-dir=\([^ ]*\)" | awk -F'=' '{print $2}') \
    && cd ../../ \
    && rm -r cphalcon-${PHALCON_VERSION}

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
CMD ["php-fpm"]
