const server = require('http').createServer();

const io = require('socket.io')(server);

server.listen(80);

io.on("connection", function(socket) {
    let email = socket.handshake.queue.email;

    socket.broadcast.emit();

    socket.on("send-data", function (data) {
        console.log(socket.id + ' send ' + data);

        io.sockets.emit('server-send', data + " from server");
    });

    socket.on("disconnect", function () {
        console.log(socket.id + ' disconnect');
    });
});
