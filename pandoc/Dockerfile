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
         composer \
         unzip \
   && rm -rf /var/lib/apt/lists/*

# Smoke test
RUN pandoc --version \
   && php --version

WORKDIR /wiki-migration
ENTRYPOINT [""]
