


<p id="power">0</p>



    <script src="{{ asset('js/socket.io.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        var socket = io('http://127.0.0.1:6001');
//        var socket = io('http://192.168.10.10:3000');
        socket.on("test-channel:App\\Events\\sendMessage", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
    </script>
