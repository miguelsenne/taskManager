#!/bin/bash

cd ${TRAVIS_BUILD_DIR}

if [[ $TRAVIS_PHP_VERSION = '7.2' ]]; then
    phpunit
    ${pwd}/vendor/bin/phpcs
fi

if [[ $TRAVIS_PHP_VERSION = '7.3' ]]; then
    phpunit
    ${pwd}/vendor/bin/phpcs
fi