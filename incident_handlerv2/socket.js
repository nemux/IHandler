var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis({
    port: 8001,          // Redis port
    host: '10.30.4.18',   // Redis host
    family: 4,           // 4 (IPv4) or 6 (IPv6)
    password: 'auth',
    db: 0
});

redis.subscribe('test-channel', function (err, count) {
});

redis.on('message', function (channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(8002, function () {
    console.log('Listening on Port 8001');
});