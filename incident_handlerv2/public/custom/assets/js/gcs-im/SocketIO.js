var socket_opts = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

var SocketIO = SocketIO || (function () {
        var _host = {};
        var _port = {};
        var _socket;

        return {
            init: function (host, port) {
                _host = host;
                _port = port;
            }, start: function () {
                _socket = io('http://' + _host + ':' + _port);
                _socket.on("test-channel:App\\Events\\EventName", function (message) {
                    toastr.success(message.data, "Mensaje", socket_opts);
                });
            }
        };
    }());