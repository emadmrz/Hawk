<div class="container">
    <div class="cover profile">

        <div class="wrapper" id="coverContainer">
            <div  class="image">
                <img id="cover-image" src="{{ asset('img/cover/'.$user->banner) }}" alt="people">
                <div class="avatar-operations">
                    <a href="#" class="avatar-view" data-type="cover" data-ratio="4" ><i class="fa fa-camera" ></i></a>
                    {!! Form::open(['url'=>'profile/deleteCover', 'method'=>'delete', 'data-delete-confirm', 'data-delete-message'=>'آیا مطمئین هستید تصور کاور پروفایل حذف شود ؟']) !!}
                        {!! Form::button("<i class='fa fa-times-circle'></i>", ['type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="description">
                    {!! Form::model($user, ['url'=>'profile/description', 'data-remote']) !!}
                    @role('user')
                    {!! Form::text('description', null, ['placeholder'=>'درباره من...']) !!}
                    @endrole
                    @role('legal')
                    {!! Form::text('description', null, ['placeholder'=>'درباره ما...']) !!}
                    @endrole
                    {!! Form::button("<i class='fa fa-save'></i>", ['type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="curve">
                </div>
            </div>
            @include('profile.partials.cropper', ['type'=>'cover'])
        </div>

        <div class="cover-info" id="avatarContainer">
            <div class="avatar">
                <img id="avatar-image" src="{{ asset('img/persons/'.$user->avatar) }}" alt="people">
                <div class="avatar-operations">
                    <a href="#" class="avatar-view" data-type="avatar" data-ratio="1" ><i class="fa fa-camera" ></i></a>
                    {!! Form::open(['url'=>'profile/deleteAvatar', 'method'=>'delete', 'data-delete-confirm', 'data-delete-message'=>'آیا مطمئین هستید تصور پروفایل حذف شود ؟']) !!}
                        {!! Form::button("<i class='fa fa-times-circle'></i>", ['type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="name"><a href="#">{{ $user->username }}</a></div>
            <ul class="cover-nav">
                <li><a href="{{ route('home.home') }}"><i class="fa fa-home"></i> خانه</a></li>
                <li><a href="{{ route('profile.me') }}"><i class="fa fa-briefcase"></i> پروفایل</a></li>
                <li><a href="{{ route('profile.skill.list') }}"><i class="fa fa-trophy"></i> مهارت ها</a></li>
                <li><a href="{{route('profile.dashboard.index')}}"><i class="fa fa-pie-chart"></i> داشبورد</a></li>
                <li><a href="{{ route('profile.friends') }}"><i class="fa fa-users"></i> دوستان</a></li>
                <li class="dropdown">
                    <a id="post_article" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa  fa-pencil-square-o"></i> نگاره ها </a>
                    <ul class="dropdown-menu" aria-labelledby="post_article">
                        <li><a href="{{ route('profile.article.create') }}" ><i class="fa fa-newspaper-o fa-1x"></i> ارسال مقاله </a></li>
                        <li><a href="{{ route('profile.articles') }}" ><i class="fa fa-newspaper-o fa-1x"></i> مقاله ها </a></li>
                        <li><a href="{{ route('profile.post.list') }}" ><i class="fa fa-pencil-square-o fa-1x"></i> پست ها </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" id="setting_menu" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> تنظیمات</a>
                    <ul class="dropdown-menu" aria-labelledby="setting_menu">
                        <li><a href="{{ route('profile.setting.storage') }}" ><i class="fa fa-database fa-1x"></i> حجم پروفایل </a></li>
                        <li><a href="{{ route('profile.setting.password') }}" ><i class="fa fa-lock fa-1x"></i> تغییر کلمه عبور </a></li>
                        <li><a href="{{ route('profile.setting.password') }}" ><i class="fa fa-lock fa-1x"></i>آگهی های استخدام </a></li>
                        <li><a href="#"><i class="fa fa-bug" ></i>گزارش خطاها و باگ  </a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" id="management_accountant_menu" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i> مدیریت مالی و افزونه ها </a>
                    <ul class="dropdown-menu" aria-labelledby="management_accountant_menu">
                        <li><a href="{{ route('profile.management.credit') }}" ><i class="fa fa-credit-card fa-1x"></i> حساب مالی من </a></li>
                        <li><a href="{{ route('profile.management.accountant') }}" ><i class="fa fa-bank fa-1x"></i> مدیریت پرداخت ها </a></li>
                        <li><a href="{{ route('profile.management.addon.showcase.myRequest') }}" ><i class="fa fa-bullhorn fa-1x"></i>مدیریت تبلیغات پروفایل</a></li>
                        @if(count($user->coupons))
                            <li><a href="{{ route('profile.coupons.bought') }}" ><i class="fa fa-money fa-1x"></i> کوپن های من </a></li>
                        @endif
                        @if(count($user->storages))
                            <li><a href="{{ route('profile.management.addon.storage') }}" ><i class="fa fa-database fa-1x"></i> افزونه افزایش حجم </a></li>
                        @endif
                        @if(count($user->polls))
                            <li><a href="{{ route('profile.management.addon.poll') }}" ><i class="fa fa-bar-chart-o fa-1x"></i> افزونه نظرسنجی </a></li>
                        @endif
                        @if(count($user->questionnaires))
                            <li><a href="{{ route('profile.management.addon.questionnaire') }}" ><i class="fa fa-hand-pointer-o fa-1x"></i> افزونه پرسشنامه </a></li>
                        @endif
                        @if(count($user->shop))
                            <li><a href="{{ route('profile.management.addon.shop') }}" ><i class="fa fa-shopping-cart fa-1x"></i> افزونه فروشگاه ساز </a></li>
                        @endif
                        @if(count($user->advertises))
                            <li><a href="{{ route('profile.management.addon.advertise') }}" ><i class="fa fa-flag-checkered fa-1x"></i>افزونه تبلیغات در صفحه اول</a></li>
                        @endif
                        @if(count($user->offers))
                            <li><a href="{{ route('profile.management.addon.offer') }}" ><i class="fa fa-diamond fa-1x"></i>افزونه پیشنهاد ویژه</a></li>
                        @endif
                        @if(count($user->recruitments))
                            <li><a href="{{ route('profile.management.addon.recruitment') }}" ><i class="fa fa-diamond fa-1x"></i>افزونه آگهی استخدام</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            @include('profile.partials.cropper', ['type'=>'avatar'])
        </div>

    </div>
</div>

