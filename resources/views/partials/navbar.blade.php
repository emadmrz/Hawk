@if(Auth::check())
    @section('socket.io')
        <script src="{{ asset('js/socket.io.js') }}"></script>
        <script>
            var socket = io('http://127.0.0.1:6001', { query: "user={{ $authUser->id }}" });

            socket.on("user.{{ Auth::user()->id }}:App\\Events\\Notification", function(data){
                if($("nav").find("#new_notifications_num").find('.notification_num').length > 0){
                    var current_notifications_num = parseInt($("nav").find("#new_notifications_num").find('.notification_num').html());
                    $("nav").find("#new_notifications_num").html('<i class="notification_num">'+parseInt(current_notifications_num+1)+'</i>');
                }else{
                    $("nav").find("#new_notifications_num").html('<i class="notification_num">1</i>');
                }

                if(!$('.notify-alert').length){
                    $.notify(data.notification, {type:'notification', delay: 10000});
                }
            });

            socket.on("user.{{ $authUser->id }}:App\\Events\\friendRequest", function(data){
                if($("nav").find("#new_friend_request_num").find('.notification_num').length > 0){
                    var current_notifications_num = parseInt($("nav").find("#new_friend_request_num").find('.notification_num').html());
                    $("nav").find("#new_friend_request_num").html('<i class="notification_num">'+parseInt(current_notifications_num+1)+'</i>');
                }else{
                    $("nav").find("#new_friend_request_num").html('<i class="notification_num">1</i>');
                }

                if(!$('.notify-alert').length){
                    $.notify(data.notification, {type:'notification', delay: 10000});
                }
            });

            @if(!strpos(URL::current(),route('chat.index')))
                socket.on("user.{{ $authUser->id }}:App\\Events\\sendMessage", function(data){
                    if($("nav").find("#new_messages_num").find('.notification_num').length > 0){
                        var current_notifications_num = parseInt($("nav").find("#new_messages_num").find('.notification_num').html());
                        $("nav").find("#new_messages_num").html('<i class="notification_num">'+parseInt(current_notifications_num+1)+'</i>');
                    }else{
                        $("nav").find("#new_messages_num").html('<i class="notification_num">1</i>');
                    }

                    if(!$('.notify-alert').length){
                        $.notify(messageCreate(data.data), {type:'notification', delay: 10000});
                    }
                });

                function messageCreate(data){
                    return '<div class="media">'+
                            '<div class="media-right">'+
                            '<a href="#">'+
                            '<img class="media-object img-rounded" src="{{ asset('img/persons')  }}/'+data.avatar+'" alt="" >'+
                            '</a>'+
                            '</div>'+
                            '<div class="media-body">'+
                            '<h5 class="media-heading"><a href="#">'+data.username+'</a><span class="info">'+data.created_at+'</span></h5>'+
                            '<p>'+data.message+'</p>'+
                            '</div>'+
                            '</div>';
                }
            @endif


            $.notifyDefaults({
                delay: 5000,
                timer: 100,
                offset: {
                    x: 10,
                    y:60
                },
                placement: {
                    from: "bottom",
                    align: "right"
                },
                animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
                }
            });

        </script>
    @endsection
    <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo/skillema.png') }}"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <!--<ul class="nav navbar-nav  top-menu">-->
            <!--<li><a href="#"><i class="glyphicon glyphicon-info-sign"></i><span class="title">درباره ما بیشتر بدانید</span></a></li>-->
            <!--</ul>-->
            <ul class="nav navbar-nav navbar-right tools-nav">
                <li class="avatar">
                    <a id="my_account_nav_dropdown" href="#" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/persons/'.$authUser->avatar) }}" class="img-circle" ></a>
                    <ul class="dropdown-menu my-profile-account" aria-labelledby="my_account_nav_dropdown">
                        <li><a href="{{ route('home.home') }}"><i class="fa fa-home fa-lg"></i> خانه </a></li>
                        <li><a href="{{ route('profile.me') }}"><i class="fa fa-briefcase fa-lg"></i> پروفایل </a></li>
                        <li><a href="#"><i class="fa fa-pie-chart fa-lg"></i> داشبود </a></li>
                        <li><a href="{{ route('profile.management.credit') }}"><i class="fa fa-credit-card fa-lg"></i>حساب مالی من</a></li>
                        <li><a href="{{ url('auth/logout') }}" class="exit"><i class="fa fa-power-off fa-lg"></i>خروج از سایت</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="new_notifications_nav">
                    <a  id="new_notifications_nav_dropdown" href="#" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell-o fa-2x"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="new_notifications_nav_dropdown">

                    </ul>
                    <span id="new_notifications_num"></span>

                </li>
                <li class="dropdown" id="friends_request_nav">
                    <a id="friend_request_nav_dropdown" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-plus fa-2x"></i>
                    </a>
                    <ul id="friendship_list" class="dropdown-menu" aria-labelledby="friend_request_nav_dropdown">

                    </ul>
                    <span id="new_friend_request_num"></span>
                </li>
                <li class="dropdown" id="new_messages_nav">
                    <a  id="new_messages_nav_dropdown" href="#" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope-o fa-2x"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="new_notifications_nav_dropdown">

                    </ul>
                    <span id="new_messages_num"></span>

                </li>
                <li class="dropdown">
                    <a  id="top_nav_dropdown" href="#" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-th fa-2x"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="top_nav_dropdown">
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>1,'sort'=>1,'category'=>1])}}" class="star">
                                <img src="{{ asset('img/icons/users.png') }}">
                                <i class="fa fa-star fa-2x"></i>
                            </a>
                            <span>پر ستاره ترین</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>1,'sort'=>2,'category'=>1])}}">
                                <img src="{{ asset('img/icons/users.png') }}">
                                <i class="fa fa-area-chart fa-2x  text-primary"></i>
                            </a>
                            <span>پربازدیدترین</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>1,'sort'=>3,'category'=>1])}}" class="star">
                                <img src="{{ asset('img/icons/users.png') }}">
                                <i class="fa fa-trophy fa-2x"></i>
                            </a>
                            <span>پر مشتری ترین</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>1,'sort'=>5,'category'=>1])}}" class="star">
                                <img src="{{ asset('img/icons/users.png') }}">
                                <i class="fa fa-diamond fa-2x"></i>
                            </a>
                            <span>پیشنهاد ویژه</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>1,'sort'=>4,'category'=>1])}}" class="star">
                                <img src="{{ asset('img/icons/users.png') }}">
                                <i class="fa fa-user fa-2x"></i>
                            </a>
                            <span>جدید ترین ها</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>2,'sort'=>6,'category'=>1])}}">
                                <img src="{{ asset('img/icons/products.png') }}">
                                <i class="fa fa-heart fa-2x text-danger"></i>
                            </a>
                            <span>محبوب ترین ها</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>2,'sort'=>7,'category'=>1])}}">
                                <img src="{{ asset('img/icons/products.png') }}">
                                <i class="fa fa-credit-card fa-2x text-primary"></i>
                            </a>
                            <span>پرفروش ترین ها</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>2,'sort'=>8,'category'=>1])}}">
                                <img src="{{ asset('img/icons/products.png') }}">
                                <i class="fa fa-area-chart fa-2x text-primary"></i>
                            </a>
                            <span>پر بازدیدترین ها</span>
                        </li>
                        <li class="top-user-nav">
                            <a href="{{route('top.result',['type'=>2,'sort'=>9,'category'=>1])}}">
                                <img src="{{ asset('img/icons/products.png') }}">
                                <i class="fa fa-truck fa-2x text-danger"></i>
                            </a>
                            <span>جدید ترین ها</span>
                        </li>
                        <a href="#" class="btn btn-violet btn-block">مشاهده برترین های skillema</a>
                    </ul>
                </li>
            </ul>

            {!! Form::open(['method'=>'get','route'=>'search.index','class'=>'navbar-form navbar-left search-navbar hidden-sm','role'=>'search']) !!}
                <span id="users" class="img-circle search-filter active"><i class="fa fa-user fa-2x"></i></span>
                <span id="products" class="img-circle search-filter"><i class="fa fa-shopping-cart fa-2x"></i></span>
                <div class="form-group" style="position: relative">
                    <input autocomplete="off" id="fast-search" name="query" type="text" class="form-control glass-input" style="background: #EEE ; color:#666" size="40" placeholder=" جستجوی سریع در سایت ">
                    <i style="display:none; position: absolute; top: 10px; left: 8px" class="fa fa-spinner fa-spin" id="fast_search_preloader"></i>
                </div>
                <input name="cat" type="hidden" value="users">
                <button type="submit" class="btn btn-default search-now"><i class="fa fa-search fa-lg" ></i></button>
                <span class="advance-search" ><i class="fa fa-caret-down" ></i><a href="{{ route('search.index') }}" >جستجوی پیشرفته</a></span>

                {{--Search Result Navbar--}}
                <div class="search-result-navbar" id="search-result-navbar">
                    <ul class="dropdown-menu">

                    </ul>
                </div>
                {{--Search Result Navbar End--}}

            {!! Form::close() !!}


        </div>
    </div>
</nav>

@else

    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <div class="logo" ><img src="{{ asset('img/logo/skillema_dark.png') }}"></div>
                <!--<h1>ورود به حساب کاربری</h1>-->
                <br>
                {!! Form::open(['url'=>'auth/login', 'method'=>'post', 'id'=>'login-form', 'class'=>'form-horizontal', 'data-toggle'=>'validator', 'data-disable'=>'false', 'role'=>'form', 'data-delay'=>'5000' ]) !!}
                <input type="text" name="email" placeholder="آدرس ایمیل">
                <input type="password" name="password" class="last" placeholder="کلمه عبور">
                <div class="checkbox checkbox-success">
                    <br>
                    <input id="checkbox2" type="checkbox" name="remember">
                    <label for="checkbox2">
                        من را به خاطر بسپار
                    </label>

                </div>
                <br>
                <input type="submit" name="login" class="login btn btn-violet btn-block" value="ورود به سایت">
                {!! Form::close() !!}
                <div class="login-help">
                    <a href="{{ url('auth/register') }}" class="pull-left " >پیوستن به ما</a>  <a href="{{ url('password/email') }}">فراموشی کلمه عبور</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="{{ asset('img/logo/skillema.png') }}"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav  top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-info-sign"></i><span class="title">درباره ما بیشتر بدانید</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right top-menu">
                <li><a href="#"  data-toggle="modal" data-target="#LoginModal" ><i class="fa fa-lock fa-lg"></i><span class="title">ورود به سایت</span></a></li>
                <li><a href="{{ url('auth/register') }}"><i class="glyphicon glyphicon-user"></i><span class="title">عضویت</span></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-th"></i><span class="title">برترین ها</span></a></li>
            </ul>
        </div>
    </div>
</nav>
@endif