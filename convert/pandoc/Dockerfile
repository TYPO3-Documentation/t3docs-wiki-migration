# @see https://github.com/pandoc/dockerfiles/blob/master/ubuntu/Dockerfile
FROM pandoc/ubuntu:2.11.4

ARG DEBIAN_FRONTEND=noninteractive

LABEL \
   Maintainer="TYPO3 Documentation Team" \
   Description="This image converts TYPO3 Wiki pages from HTML to reST for use in TYPO3 Docs." \
   Vendor="t3docs"

# Install PHP + Composer
RUN apt-get -q --no-allow-insecure-repositories update \
   && apt-get install --assume-yes --no-install-recommends \
         php-cli \
         php-xml \
         php-xdebug \
         composer \
         unzip \
   && rm -rf /var/lib/apt/lists/*

# Configure PHP
WORKDIR /etc/php/7.4/cli
RUN phpdismod xdebug \
   && cp php.ini php-debug.ini \
   && echo "\
zend_extension=xdebug.so \n\
xdebug.remote_enable=1 \n\
xdebug.remote_host=host.docker.internal \n\
xdebug.remote_port=9000 \
" >> php-debug.ini

# Smoke test
RUN pandoc --version \
   && php --version

WORKDIR /wiki-migration
ENTRYPOINT [""]
