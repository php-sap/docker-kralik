# Docker image for Gregor Kraliks SAP Netweaver RFC module for PHP 7

The official PHP 7.x Debian based CLI images are being used.

## Usage

**You need to get the SAP Netweaver RFC SDK for Linux and save it into this
directory as `sapnwrfc-sdk-7.50.tar.gz`.** I'm currenty trying to figure out
whether I'm legally allowed to include this SDK in a repository.

Build docker image

```shell script
docker build --pull --tag sapnwrfc:php-7.4 .
```

Copy `sap.template.json` to `sap.json` and enter your configuration.

Call RFC_PING on SAP remote system to test general functionality.

```shell script
docker run sapnwrfc:php-7.4 php test.php
```

## Build other PHP 7.x based images

```shell script
docker build --pull --file Dockerfile-7.0 --tag sapnwrfc:php-7.0 .
docker build --pull --file Dockerfile-7.1 --tag sapnwrfc:php-7.1 .
docker build --pull --file Dockerfile-7.2 --tag sapnwrfc:php-7.2 .
docker build --pull --file Dockerfile-7.3 --tag sapnwrfc:php-7.3 .
docker build --pull --file Dockerfile-7.4 --tag sapnwrfc:php-7.4 .
```
