@extends('chat.layout')

@section('content')
    <div class="chatting-with" data-friend="{{ $holder->id }}">
        @if(!empty($holder->id))
            <div class="media">
                <div class="media-right">
                    <a href="#">
                        <img class="media-object img-rounded" src="{{asset('img/persons/'.$holder->avatar)}}" alt="" >
                    </a>
                </div>
                <div class="media-body">
                    <h5 class="media-heading"><a href="#">{{ $holder->username }}</a><span class="info"></span></h5>
                </div>
            </div>
        @endif
    </div>
    <div class="panel chat" data-friend="@if(!empty($holder->id)){{ $holder->id }}@endif">
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
                            @if($history->parentable_type == 'App\User' and $history->parentable_id == $user->id)
                                <div class="message-status @if($history->status == 1) seen @endif" >
                                    @if($history->status == 1)
                                        seen
                                    @elseif($history->status == 0)
                                        unseen
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="panel-footer">
            <p id="is_typing" style="display: none" class="text-center text-muted"></p>
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

@section('right-side')
    <div class="panel chat-contacts chats-list">
        <div class="panel-body">

            <div class="list-item-image">
                <ul>
                    @foreach($chats as $chat)
                        <li>
                            <div class="media start-chat-with-friend" data-friend ="{{ $chat->first()->friend_info->id }}">
                                <div class="media-right">
                                    <a>
                                        <img class="media-object img-rounded" src="{{asset('img/persons/'.$chat->first()->friend_info->avatar)}}" alt="" >
                                        @if($chat->first()->newMessagesCount)
                                            <div class="new-message">جدید</div>
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a>{{ $chat->first()->friend_info->username }}</a><span class="info">{{ $chat->first()->latestHumanCreatedAt }}</span></h5>
                                    <p>{{ str_limit($chat->first()->latestMessage, 50) }}</p>
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

@section('left-side')
    <div class="panel chat-contacts friends-list">
        <div class="panel-body">

            <div class="list-item-image">
                <ul>
                    @foreach($friends as $friend)
                        <li>
                            <div class="media start-chat-with-friend friends-list" data-friend ="{{ $friend->friend_info->id }}">
                                <div class="media-right">
                                    <a>
                                        <img class="media-object img-rounded" src="{{asset('img/persons/'.$friend->friend_info->avatar)}}" alt="" >
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"><a>{{ $friend->friend_info->username }}</a><span class="info"></span></h5>
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

        var socket = io('http://127.0.0.1:6001', { query: "user={{ $user->id }}" });

        var messages_list = $('.panel.chat').find('.list');

        var canTypeShow = true; //a notation which show the is typing can show or not

        var holder = $('.panel.chat').attr('data-friend'); //Cache the current friend (message Holder)

        var my_id = {{ $user->id  }};

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
                    messages_list.append(myMessageCreate(data));
                    $('.panel.chat').find('.panel-body').scrollTop($('.panel.chat').find('.panel-body')[0].scrollHeight);
                    var friend_container = $('.chats-list').find('.start-chat-with-friend[data-friend="'+holder+'"]');
                    if(!friend_container.length){
                        $('.chats-list').find('.list-item-image').find('ul').prepend(createNewChat(data, 0));
                        $this.find('textarea').val('');
                        return false;
                    }
                    friend_container.find('.media-body').find('p').html(data.message);
                    friend_container.find('.media-body').find('.info').html(data.created_at);
                    var friend_container_copy = friend_container.closest('li');
                    friend_container.closest('li').remove();
                    $('.chats-list').find('.list-item-image').find('ul').prepend(friend_container_copy)
                    $this.find('textarea').val('');
                },
                error: function(xhr){
//                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
        });

        socket.on("user.{{ $user->id }}:App\\Events\\sendMessage", function(data){
            if(holder == data.data.user_id ){
                messages_list.append(messageCreate(data.data));
                $('.panel.chat').find('.panel-body').scrollTop($('.panel.chat').find('.panel-body')[0].scrollHeight);
                $("#is_typing").fadeOut(300,function(){
                    $("#is_typing").html('');
                });
                $.ajax({
                    url : '{{ route('chat.seen')  }}',
                    type : 'post',
                    data : {holder: holder}
                });
            }else{
                var friend = $('.chats-list').find('.start-chat-with-friend[data-friend="'+data.data.user_id+'"]');
                friend.find('.media-right').find('.new-message').remove();
                friend.find('.media-right').find('a').append('<div class="new-message">جدید</div>');
            }
            var friend_container = $('.chats-list').find('.start-chat-with-friend[data-friend="'+data.data.user_id+'"]');
            if(!friend_container.length){
                $('.chats-list').find('.list-item-image').find('ul').prepend(createNewChat(data.data, 1));
                return false;
            }
            friend_container.find('.media-body').find('p').html(data.data.message);
            friend_container.find('.media-body').find('.info').html(data.data.created_at);
            var friend_container_copy = friend_container.closest('li');
            friend_container.closest('li').remove();
            $('.chats-list').find('.list-item-image').find('ul').prepend(friend_container_copy)

        });

        socket.on("user.{{ $user->id }}:App\\Events\\typingMessage", function(data){
            if(holder == data.typist.id ){
                if(canTypeShow) {
                    canTypeShow = false;
                    $("#is_typing").html( data.typist.username + ' در حال نگارش متن ... ' ).fadeIn(300);
                    setTimeout(isTypingShow, 5000);
                }
            }
        });

        socket.on("user.{{ $user->id }}:App\\Events\\seenMessage", function(data){
            if(holder == data.owner ){
                messages_list.find('.message-status:not(.seen)').addClass('seen').html('seen');
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
        } //other users send message to me and I create their message with this function

        function myMessageCreate(data){
            var message =  '<div class="media">'+
                            '<div class="media-right">'+
                                '<a href="#">'+
                                    '<img class="media-object" src="{{ asset('img/persons')  }}/'+data.avatar+'" alt="" >'+
                                '</a>'+
                            '</div>'+
                            '<div class="media-body">'+
                                '<h5 class="media-heading"><a href="#">'+data.username+'</a><span class="info">'+data.created_at+'</span></h5>'+
                                '<p>'+data.message+'</p>';
                           if(data.status == 0){
                               message = message + '<div class="message-status">unseen</div>' ;
                           }else if(data.status == 1){
                               message = message + '<div class="message-status seen">seen</div>' ;
                            }
                            message = message + '</div></div>'
            return message;
        } //I send message to other users and I create my message with this function

        function createNewChat(data, isNew){
            var chat_list = '<li>'+
                '<div class="media start-chat-with-friend" data-friend ="'+data.user_id+'">'+
                    '<div class="media-right">'+
                        '<a>'+
                            '<img class="media-object img-rounded" src="{{asset('img/persons')}}/'+data.avatar+'" alt="" >';
                    if(isNew){
                        chat_list = chat_list + '<div class="new-message">جدید</div>';
                    }
                    chat_list = chat_list + '</a>'+
                    '</div>'+
                    '<div class="media-body">'+
                        '<h5 class="media-heading"><a>'+data.username+'</a><span class="info"> '+data.created_at+' </span></h5>'+
                        '<p>'+data.message+'</p>'+
                    '</div>'+
                    '</div>'+
                '</li>';
            return chat_list;
        }

        $(document).ready(function(){
            $('.panel.chat').find('.panel-body').scrollTop($('.panel.chat').find('.panel-body')[0].scrollHeight);

            $('.panel.chat').find('.panel-body').niceScroll({
                railalign : 'left',
                cursorcolor : '#EEE',
                railpadding: {
                    top: 0,
                    right: 0,
                    left: 0,
                    bottom: 0
                }
            });

            $('div.chat-contacts').on('click','.start-chat-with-friend', function(e){ //ON is used for dynamic changes in friends sort
                e.preventDefault();
                var $this = $(this);
                holder = $this.data('friend');
//                var messages_list = $('.panel.chat').find('.list');
                $("#send_message_form").find('input[name="holder"]').val(holder);
                $(".panel.chat").attr('data-friend', holder);
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
                        console.log(holder);
                        var info;
                        $this.find('.media-right').find('.new-message').remove();
                        messages_list.html('');
                        $.each(data, function(key , value){
                            console.log(value.parentable.id);
                            info ={
                                user_id : value.parentable.id,
                                avatar : value.parentable.avatar,
                                username : value.parentable.username,
                                message : value.message.message,
                                created_at : value.message.shamsi_created_at,
                                status : value.status
                            };
                            if(info.user_id == my_id){
                                messages_list.append(myMessageCreate(info));

                            }else{
                                messages_list.append(messageCreate(info));

                            }
                            $('.panel.chat').find('.panel-body').scrollTop($('.panel.chat').find('.panel-body')[0].scrollHeight);
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
//                    var holder = $('.chat-contacts').find('.start-chat-with-friend').data('friend');
                    $.ajax({
                        url : '{{ route('chat.typing')  }}',
                        type : 'post',
                        data : {holder: holder},
                        complete: function(){
                            setTimeout(isTyping, 5000);
                        }
                    });
                    {{--socket.emit('is_typing',{--}}
                        {{--channel:'user'.holder,--}}
                        {{--event:'Client\\is_typing',--}}
                        {{--data:{--}}
                            {{--user:{{$user->id}}--}}
                        {{--}--}}
                    {{--});--}}
                    {{--setTimeout(isTyping, 5000);--}}
                }
            })

            function isTyping(){
                canType = true;
//                $("#is_typing").slideDown(300,function(){
//                    $("#is_typing").html('');
//                });
            }

            $(function friends_status(){
                $.ajax({
                    url : '{{ route('api.friends.online')  }}',
                    type : 'post',
                    complete : function(){
                        setTimeout(friends_status, 15000);
                    },
                    success : function(data){
                        $.each(data, function(key, value){
                            if(value.friend_info.activity.activity_status == 1){
                                var media_container = $('.friends-list').find('.start-chat-with-friend[data-friend="'+value.friend_info.id+'"]');
                                media_container.removeClass('deactive');
                                media_container.find('.media-body').find('.offline').remove();
                                media_container.find('.media-right').find('a').find('.online').remove();
                                media_container.find('.media-right').find('a').append('<div class="online">online</div>');
                            }
                            if(value.friend_info.activity.activity_status == 0){
                                var media_container = $('.friends-list').find('.start-chat-with-friend[data-friend="'+value.friend_info.id+'"]');
                                media_container.addClass('deactive');
                                media_container.find('.media-right').find('a').find('.online').remove();
                                media_container.find('.media-body').find('.offline').remove();
                                media_container.find('.media-body').append('<div class="offline"> آخرین فعالیت '+value.friend_info.activity.shamsi_human_updated_at+'</div>');
                            }
                        });

                    }
                });
            });


        });

    </script>
@endsection