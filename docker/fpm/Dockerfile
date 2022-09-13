FROM php:8.1-fpm

# Add php installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Add entry point
COPY docker/fpm/docker-scripts-entrypoint /usr/local/bin/

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Exec mode entry point - Composer version - Install deps
RUN chmod +x /usr/local/bin/docker-scripts-entrypoint \
    && apt-get -y update && apt-get -y upgrade \
    && apt-get -y --no-install-recommends install git unzip nano vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && install-php-extensions ctype curl date dom fileinfo filter ftp hash iconv json libxml mbstring mysqlnd openssl pcre pdo pdo_mysql pdo_sqlite phar posix readline reflection session simplexml sodium spl sqlite3 tokenizer xml xmlreader xmlwriter zip zlib \
    && composer self-update 2.4.1;

# Set the default workdir
WORKDIR /var/www/html

# Remove php installer
RUN rm -rf  /usr/local/bin/install-php-extensions

# Execute the entrypoint script
ENTRYPOINT ["docker-scripts-entrypoint"]
