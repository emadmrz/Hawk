<div class="container">
    <div class="cover profile">

        <div class="wrapper" id="coverContainer">
            <div  class="image">
                <img id="cover-image" src="{{ asset('img/cover/'.$user->banner) }}" alt="people">
                <div class="avatar-operations">
                    {!! Form::open(['route'=>['home.profile.sticky.store', $user->id], 'data-remote']) !!}
                        <button type="submit"><i class='fa fa-paperclip'></i><span style="font-size: 12px; margin-right: 3px">پرچسب گذاری</span></button>
                    {!! Form::close() !!}
                </div>
                <div class="description">
                    @if(!empty($user->description))
                        {!! Form::text('description', $user->description) !!}
                    @endif
                </div>
                <div class="curve">
                </div>
            </div>
            @include('profile.partials.cropper', ['type'=>'cover'])
        </div>

        <div class="cover-info" id="avatarContainer">
            <div class="avatar">
                <img id="avatar-image" src="{{ asset('img/persons/'.$user->avatar) }}" alt="people">
            </div>
            <div class="name"><a href="#">{{ $user->username }}</a></div>
            <ul class="cover-nav">
                <li><a href="{{ route('home.home') }}"><i class="fa fa-home"></i> خانه</a></li>
                <li><a href="{{ route('home.profile', [$user->id]) }}"><i class="fa fa-briefcase"></i> پروفایل</a></li>
                <li><a href="{{ route('home.skill.list', [$user->id]) }}"><i class="fa fa-trophy"></i> مهارت ها</a></li>
                <li><a href="#"><i class="fa fa-pie-chart"></i> داشبورد</a></li>
                <li><a href="#"><i class="fa fa-users"></i> دوستان</a></li>
                <li><a href="#"><i class="fa  fa-pencil-square-o"></i> پست ها</a></li>
                <li><a href="#"><i class="fa fa-cogs"></i> تنظیمات</a></li>
            </ul>
            <span class="pull-left" id="friending">
                {!! Form::open(['route'=>'home.friend.request', 'method'=>'post', 'data-remote']) !!}
                    <input type="hidden" name="profile" value="{{ $user->id }}">
                @if($user->isFriend == 0)
                    <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-user-plus"></i> درخواست دوستی </button>
                @elseif($user->isFriend == 2)
                    <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-hand-peace-o"></i> منتظر تایید دوستی </button>
                @else
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-hand-peace-o"></i> دوست شما </button>
                @endif
                {!! Form::close() !!}
            </span>
        </div>

    </div>
</div>

