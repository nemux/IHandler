#!/bin/bash

cd /home/diego/proyects/handler/incident_handlerv2/
php artisan serve --host 0.0.0.0 --port 8000  & nodejs socket.js