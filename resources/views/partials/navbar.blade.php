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
                    <a id="my_account_nav_dropdown" href="#" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/persons/'.Auth::user()->avatar) }}" class="img-circle" ></a>
                    <ul class="dropdown-menu my-profile-account" aria-labelledby="my_account_nav_dropdown">
                        <li><a href="{{ route('home.home') }}"><i class="fa fa-home fa-lg"></i> خانه </a></li>
                        <li><a href="{{ route('profile.me') }}"><i class="fa fa-briefcase fa-lg"></i> پروفایل </a></li>
                        <li><a href="#"><i class="fa fa-pie-chart fa-lg"></i> داشبود </a></li>
                        <li><a href="#"><i class="fa fa-money fa-lg"></i>حساب مالی من</a></li>
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
                <li><a href="#"><i class="fa fa-envelope-o fa-2x"></i></a></li>
                <li><a href="#"><i class="fa fa-th fa-2x"></i></a></li>
            </ul>

            <form class="navbar-form navbar-left search-navbar hidden-sm" role="search">
                <span id="users" class="img-circle search-filter active"><i class="fa fa-shopping-cart fa-2x"></i></span>
                <span id="products" class="img-circle search-filter"><i class="fa fa-user fa-2x"></i></span>
                <div class="form-group">
                    <input type="text" class="form-control glass-input" style="background: #EEE ; color:#666" size="40" placeholder=" جستجوی سریع در سایت ">
                </div>
                <button type="submit" class="btn btn-default search-now"><i class="fa fa-search fa-lg" ></i></button>
                <span class="advance-search" ><i class="fa fa-caret-down" ></i><a href="#" >جستجوی پیشرفته</a></span>
            </form>

        </div>
    </div>
</nav>