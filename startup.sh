#!/bin/bash

php artisan migrate

yarn build

php artisan octane:frankenphp
