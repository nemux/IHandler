//Cargamos el archivo de entorno del socket (.env file)
var env = require('node-env-file');
env('.env');

//Cargamos las opciones para el socket io
var fs = require('fs');
var options = {
    key: fs.readFileSync('ssl/gcs-imanager.key'),
    cert: fs.readFileSync('ssl/gcs-imanager.crt'),
    requestCert: true
};

var https_app = require('express')();
var https_server = require('https').createServer(options, https_app);
var io = require('socket.io').listen(https_server);
var redis = require('ioredis')({
    port: process.env.REDIS_PORT,
    host: process.env.REDIS_HOST,
    password: process.env.REDIS_PASSWORD
});

https_server.listen(process.env.NODEJS_PORT_SSL, function () {
    console.log('Listening on SSL Port ' + process.env.NODEJS_PORT_SSL);
});

redis.subscribe('test-channel', function (err, count) {
});

redis.on('message', function (channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});