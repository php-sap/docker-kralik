# PHP docker image for SAP Netweaver RFC

This image compiles [Gregor Kraliks `sapnwrfc` PHP module][kralik] for PHP 7.x and 8.x.

## Usage

**First you need to [download the SAP Netweaver][sapnwrfcsdk] RFC SDK 7.50 for
Linux and save it into this directory as `sapnwrfc-sdk-7.50.tar.gz`.**

Build default docker image based on `php:7.4-cli-buster`.

```shell script
docker build --pull --tag sapnwrfc:php-7.4 .
```

Copy `sap.template.json` to `sap.json` and enter your configuration.

Call RFC_PING on SAP remote system to test general functionality.

```shell script
docker run --rm -v "$(pwd)":/app --workdir /app sapnwrfc:php-7.4 php test.php
```

## Build other PHP 7.x and 8.x based images

```shell script
docker build --pull --build-arg PHP_VERSION=7.0-cli --tag sapnwrfc:php-7.0 .
docker build --pull --build-arg PHP_VERSION=7.1-cli --tag sapnwrfc:php-7.1 .
docker build --pull --build-arg PHP_VERSION=7.2-cli --tag sapnwrfc:php-7.2 .
docker build --pull --build-arg PHP_VERSION=7.3-cli --tag sapnwrfc:php-7.3 .
docker build --pull --build-arg PHP_VERSION=7.4-cli --tag sapnwrfc:php-7.4 .
docker build --pull --build-arg PHP_VERSION=8.1-cli --tag sapnwrfc:php-8.1 .
docker build --pull --build-arg PHP_VERSION=8.2-cli --tag sapnwrfc:php-8.2 .
docker build --pull --build-arg PHP_VERSION=8.1-cli --build-arg SAPNWRFC_VERSION=2.0.0-beta3 --tag sapnwrfc2:php-8.1 .
docker build --pull --build-arg PHP_VERSION=8.2-cli --build-arg SAPNWRFC_VERSION=2.0.0-beta3 --tag sapnwrfc2:php-8.2 .
```

Example call for version 2 module:

```shell
docker run --rm -v "$(pwd)":/app --workdir /app sapnwrfc2:php-8.2 php test.php
```

## Annotations

Starting with PHP 8.2 the `sapnwrfc` PHP module 1.4.0 is causing deprecation warnings.

## License

[MIT License](LICENSE)

Copyright (c) 2020 PHP/SAP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


## Legal notice

SAP and other SAP products and services mentioned herein are trademarks or
registered trademarks of SAP SE (or an SAP affiliate company) in Germany and
other countries.

[kralik]: https://github.com/gkralik/php7-sapnwrfc "SAP NW RFC SDK extension for PHP7"
[sapnwrfcsdk]: https://gkralik.github.io/php7-sapnwrfc/installation.html#download-the-sap-nw-rfc-library "Download SAP Netweaver RFC SDK 7.50"
