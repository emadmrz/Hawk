@extends('chat.layout')

@section('content')
    <div class="panel chat">
        <div class="panel-body">
            <div class="list">

                @foreach($histories as $history)
                    <div class="media">
                        <div class="media-right">
                            <a href="#">
                                <img class="media-object" src="{{asset('img/persons/'.$history->parentable->avatar)}}" alt="" >
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">{{ $history->parentable->username }}</a><span class="info">{{ $history->shamsi_created_at }}</span></h5>
                            <p>{{ $history->message->message }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            <p id="is_typing" style="display: none" class="text-center text-muted"></p>
        </div>
        <div class="panel-footer">

            <div class="new-comment">
                {!! Form::open(['route'=>['store.offer.comment'], 'method'=>'post', 'id'=>'send_message_form']) !!}
                <div class="media">
                    <div class="media-right">
                        <a href="#">
                            <img class="media-object" src="{{asset('img/persons/'.$user->avatar)}}" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <textarea name="message" placeholder="شما هم میتوانید نظر خود را درباره این افزونه بیان نمایید ."></textarea>

                        <input type="hidden" name="holder" value="@if(!empty($holder->id)){{ $holder->id }}@endif">
                    </div>
                </div>
                <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-paper-plane-o"></i> ثبت دیدگاه </button>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
@endsection



@section('side')
    <div class="panel chat-contacts">
        <div class="panel-body">

            <div class="list-item-image">
                <ul>
                    @foreach($friends as $friend)
                        {{ $chatRepository->latest($friend->friend_info->id) }}
                        <li>
                            <div class="media start-chat-with-friend" data-friend ="{{ $friend->friend_info->id }}">
                                <div class="media-right">
                                    <a>
                                        <img class="media-object img-rounded" src="{{asset('img/persons/'.$friend->friend_info->avatar)}}" alt="" >
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a>{{ $friend->friend_info->username }}</a><span class="info">{{ $chatRepository->latestCreatedAt() }}</span></h5>
                                    <p>{{ $chatRepository->latestMessage() }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


        </div>
        <div class="panel-footer">
            aaa
        </div>
    </div>
@endsection

@section('script')
    <script>
        var socket = io('http://127.0.0.1:6001', { query: "user = {{ $user->id }}" });
        var messages_list = $('.panel.chat').find('.list');
        var canTypeShow = true;
        $('form#send_message_form').submit(function(e){
            e.preventDefault();
            var $this = $(this);
            var data = $this.serialize();
            $.ajax({
                url : '{{ route('chat.send', $user->id)  }}',
                type : 'post',
                data : data,
                dataType: 'json',
                beforeSend: function(){
                    $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
                },
                complete: function(){
                    $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-paper-plane-o');
                },
                success: function(data){
                    messages_list.append(messageCreate(data));
                    $('.start-chat-with-friend').find('.media-body').find('p').html(data.message);
                    $('.start-chat-with-friend').find('.media-body').find('.info').html(data.created_at);
                    $this.find('textarea').val('');
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        });
        socket.on("user.{{ $user->id }}:App\\Events\\sendMessage", function(data){
            messages_list.append(messageCreate(data.data));
            $('.start-chat-with-friend').find('.media-body').find('p').html(data.data.message);
            $('.start-chat-with-friend').find('.media-body').find('.info').html(data.data.created_at);
            $("#is_typing").fadeOut(300,function(){
                $("#is_typing").html('');
            });
        });
        socket.on("user.{{ $user->id }}:App\\Events\\typingMessage", function(data){
            if(canTypeShow) {
                canTypeShow = false;
                $("#is_typing").html( data.typist.username + ' در حال نگارش متن ... ' ).fadeIn(300);
                setTimeout(isTypingShow, 5000);
            }
        });

        function isTypingShow(){
            canTypeShow = true;
            $("#is_typing").fadeOut(300,function(){
                $("#is_typing").html('');
            });
        }

        function messageCreate(data){
            return '<div class="media">'+
                    '<div class="media-right">'+
                        '<a href="#">'+
                            '<img class="media-object" src="{{ asset('img/persons')  }}/'+data.avatar+'" alt="" >'+
                        '</a>'+
                    '</div>'+
                    '<div class="media-body">'+
                        '<h5 class="media-heading"><a href="#">'+data.username+'</a><span class="info">'+data.created_at+'</span></h5>'+
                        '<p>'+data.message+'</p>'+
                    '</div>'+
                '</div>';
        }



    </script>

    <script>

        $(document).ready(function(){

            $('.chat-contacts').find('.start-chat-with-friend').click(function(e){
                e.preventDefault();
                var $this = $(this);
                var holder = $this.data('friend');
                var messages_list = $('.panel.chat').find('.list');
                $("#send_message_form").find('input[name="holder"]').val(holder);
                $.ajax({
                    url : '{{ route('chat.history')  }}',
                    type : 'post',
                    data : {holder: holder},
                    dataType: 'json',
                    beforeSend: function(){
//                        $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
                    },
                    complete: function(){
//                        $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-paper-plane-o');
                    },
                    success: function(data){
                        console.log(data);
                        var info;
                        messages_list.html('');
                        $.each(data, function(key , value){
                            console.log(value.parentable.id);
                            info ={
                                user_id : value.parentable.id,
                                avatar : value.parentable.avatar,
                                username : value.parentable.username,
                                message : value.message.message,
                                created_at : value.message.shamsi_created_at
                            };
                            messages_list.append(messageCreate(info));
                        });
                    },
                    error: function(xhr){
                        alert("An error occured: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });

            var canType = true;
            $('form#send_message_form').find('textarea').keypress(function(){
                if(canType){
                    canType = false;
                    var holder = $('.chat-contacts').find('.start-chat-with-friend').data('friend');
                    $.ajax({
                        url : '{{ route('chat.typing')  }}',
                        type : 'post',
                        data : {holder: holder},
                        complete: function(){
                            setTimeout(isTyping, 5000);
                        }
                    });
                }
            })

            function isTyping(){
                canType = true;
                $("#is_typing").fadeOut(300,function(){
                    $("#is_typing").html('');
                });
            }


        });

    </script>
@endsection