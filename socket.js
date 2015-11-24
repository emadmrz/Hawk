var app = require('http').createServer(handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(6001, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

io.on('connection', function(socket) {
    //
});

//sending additional data to socket when connect
io.use(function(socket, next){
    console.log("Query: ", socket.handshake.query.foo);
    // return the result of next() to accept the connection.
    //if (socket.handshake.query.foo == "bar") {
        return next();
    //}
    //// call next() with an Error if you need to reject the connection.
    //next(new Error('Authentication error'));
});

redis.psubscribe('*', function(err, count) {
    //
});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});