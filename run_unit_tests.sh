#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

if [[ -x "/usr/bin/php7.0" ]] ; then
    PHP=/usr/bin/php7.0
else
    PHP=php
fi

$PHP $DIR/bin/phpunit -c $DIR/test/phpunit.xml $DIR/test --testdox --colors=always
