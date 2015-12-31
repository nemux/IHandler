var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');

var assert = require('assert');
var env = require('node-env-file');

//Cargamos el archivo de environment
env('.env');

var redis = new Redis({
    port: process.env.REDIS_PORT,
    host: process.env.REDIS_HOST,
    password: process.env.REDIS_PASSWORD
});

redis.subscribe('test-channel', function (err, count) {
});

redis.on('message', function (channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(process.env.NODEJS_PORT, function () {
    console.log('Listening on Port ' + process.env.NODEJS_PORT);
});