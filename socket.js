var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var mysql      = require('mysql');

var Redis = require('ioredis');
var redis = new Redis();
var clients;


app.listen(6001, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'skillema'
});

io.on('connection', function(socket) {

    connection.query("UPDATE `"+connection.config.database+"`.`activities` SET `online` = '1' WHERE `activities`.`user_id` = "+socket.handshake.query.user, function(err, rows, fields) {
        if (!err)
            //console.log('The solution is: ', rows);
            console.log('Connected');
        else
            console.log('Error while performing Query.');
    });

    socket.on('disconnect', function() {
        connection.query("UPDATE `"+connection.config.database+"`.`activities` SET `online` = '0', `updated_at` = NOW() WHERE `activities`.`user_id` = "+socket.handshake.query.user, function(err, rows, fields) {
            if (!err)
                //console.log('The solution is: ', rows);
                console.log('Disconnected');
            else
                console.log('Error while performing Query.');
        });
    });

    //socket.on('is_typing', function(data){
    //    io.emit('user.'.data.holder, data);
    //});

});




//sending additional data to socket when connect
io.use(function(socket, next){
    //console.log("Query: ", socket.handshake.query);
    //var user_id = socket.handshake.query.user;
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