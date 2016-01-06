#!/usr/bin/env bash
echo "-----------------------------------------------"
echo "|  Iniciando la actualización del aplicativo  |"
echo "-----------------------------------------------"
php artisan down; git checkout HEAD^ update.sh; git pull; composer update; php artisan cache:clear; composer dumpautoload -o; chmod 700 update.sh; php artisan up
echo "-----------------------------------------------"
echo "|  Finalizó  la actualización del aplicativo  |"
echo "-----------------------------------------------"