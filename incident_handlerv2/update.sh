#!/usr/bin/env bash
echo "---------------------------------------------"
echo "| Iniciando la actualización del aplicativo |"
echo "---------------------------------------------"
php artisan down; git pull; composer update; php artisan cache:clear; composer dumpautoload -o; php artisan up
echo "---------------------------------------------"
echo "| Finalizó  la actualización del aplicativo |"
echo "---------------------------------------------"