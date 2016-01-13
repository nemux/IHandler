#!/usr/bin/env bash
echo "-----------------------------------------------"
echo "|  Iniciando la actualización del aplicativo  |"
echo "-----------------------------------------------"
php artisan down; git reset --hard; git pull; composer update; php artisan cache:clear; composer dumpautoload -o; chmod 700 update.sh; chmod 700 runsocket.sh; php artisan up
echo "-----------------------------------------------"
echo "|  Finalizó  la actualización del aplicativo  |"
echo "-----------------------------------------------"