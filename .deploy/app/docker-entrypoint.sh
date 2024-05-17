#!/usr/bin/env sh

# Stop on any error

sleep 10

if [[ ! -f '/app/storage/init' ]]; then
  echo 'Init container'

#  php artisan optimize:clear
#  php artisan migrate

#  touch '/app/storage/init'
fi

php-fpm -O -F
