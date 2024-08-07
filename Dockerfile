ARG PHP_VERSION=8.1-cli-bookworm
FROM php:${PHP_VERSION}

# Add and extract SAP Netweaver RFC SDK.
ADD sapnwrfc-sdk-7.50.tar.gz /usr/sap/nwrfcsdk/

# Version of Gregor Kraliks SAP Netweaver RFC module source code for PHP 7
ARG SAPNWRFC_VERSION=2.1.0

RUN set -xe; \
    docker-php-source extract; \
    # SAP netweaver RFC SDK should be installed...
    echo "/usr/sap/nwrfcsdk/lib" > /etc/ld.so.conf.d/sapnwrfc.conf; \
    ldconfig; \
    # Download Gregor Kraliks SAP Netweaver RFC module source code for PHP 7
    cd /usr/src; \
    curl --insecure --fail --location --remote-name "https://github.com/gkralik/php7-sapnwrfc/archive/${SAPNWRFC_VERSION}.tar.gz"; \
    # Extract the module sources.
    tar xzf ${SAPNWRFC_VERSION}.tar.gz; \
    cd php7-sapnwrfc-${SAPNWRFC_VERSION}; \
    # Configure and build the module.
    phpize; \
    ./configure --with-sapnwrfc=/usr/sap/nwrfcsdk; \
    make; \
    make install; \
    cd ..; \
    # cleanup
    rm -Rf php7-sapnwrfc-${SAPNWRFC_VERSION}/ ${SAPNWRFC_VERSION}.tar.gz; \
    docker-php-source delete; \
    # Enable freshly compiled SAP Netweaver RFC module.
    # How to enable PHP modules depends on your *nix flavor.
    # The official PHP docker images do it this way.
    docker-php-ext-enable sapnwrfc;
