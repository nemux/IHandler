#!/usr/bin/env bash
php artisan down; git pull; composer update; php artisan cache:clear; composer dumpautoload -o; php artisan up