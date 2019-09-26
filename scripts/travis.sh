#!/bin/bash

cd ${TRAVIS_BUILD_DIR}

./vendor/bin/phpunit
./vendor/bin/phpcs

