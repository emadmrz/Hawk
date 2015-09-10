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
                <div class="curve">
                    <div class="description">
                        {!! Form::model($user, ['url'=>'profile/description', 'data-remote']) !!}
                            {!! Form::text('description', null, ['placeholder'=>'درباره من...']) !!}
                            {!! Form::button("<i class='fa fa-save'></i>", ['type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </div>
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
                <li><a href="#"><i class="fa fa-home"></i> خانه</a></li>
                <li><a href="#"><i class="fa fa-briefcase"></i> پروفایل</a></li>
                <li><a href="#"><i class="fa fa-trophy"></i> مهارت ها</a></li>
                <li><a href="#"><i class="fa fa-pie-chart"></i> داشبورد</a></li>
                <li><a href="#"><i class="fa fa-users"></i> دوستان</a></li>
                <li><a href="#"><i class="fa  fa-pencil-square-o"></i> پست ها</a></li>
                <li><a href="#"><i class="fa fa-cogs"></i> تنظیمات</a></li>
            </ul>
            @include('profile.partials.cropper', ['type'=>'avatar'])
        </div>

    </div>
</div>

