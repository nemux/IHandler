#!/usr/bin/env bash
git pull; composer update; php artisan cache:clear; composer dumpautoload -o;