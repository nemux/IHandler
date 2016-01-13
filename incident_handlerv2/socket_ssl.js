var express = require('express');
var https_app = express();
//var http_app = express();
var fs = require('fs');
var Redis = require('ioredis');
var options = {
    key: fs.readFileSync('./ssl/gcs-imanager.key'),
    cert: fs.readFileSync('./ssl/gcs-imanager.crt'),
    requestCert: true
};
var redis = new Redis({
    port: process.env.REDIS_PORT,
    host: process.env.REDIS_HOST,
    password: process.env.REDIS_PASSWORD
});
//var http = require('http').createServer(http_app);
var https = require('https').createServer(options, https_app);
var io = require('socket.io').listen(https);

var env = require('node-env-file');
env('.env');

redis.subscribe('test-channel', function (err, count) {
});

redis.on('message', function (channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

//http_app.get('*', function (req, res) {
//    //Redirige el tráfico no seguro por el canal seguro
//    res.redirect('https://' + process.env.NODEJS_HOST + ':' + process.env.NODEJS_PORT_SSL + req.url)
//});

https.listen(process.env.NODEJS_PORT_SSL, function () {
    console.log('Listening on Port ' + process.env.NODEJS_PORT_SSL);
});

//http.listen(process.env.NODEJS_PORT, function () {
//console.log('Listening on Port ' + process.env.NODEJS_PORT);
//});