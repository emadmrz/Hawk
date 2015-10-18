@extends('profile.layout')

@section('side')
    @include('profile.partials.settingMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                تغییر کلمه عبور
            </div>
            <div class="panel-body">

                {!! Form::open(['route'=>'profile.setting.changePassword', 'method'=>'post', 'id'=>'change-password-form', 'class'=>'form-horizontal panel-form', 'data-toggle'=>'validator', 'data-disable'=>'false', 'role'=>'form' ]) !!}

                    <div class="form-group">
                        {!! Form::label('email', ' آدرس ایمیل :  ', ['class'=>'control-label col-sm-2 pull-right'] ) !!}
                        <div class="col-sm-4">
                            {!! Form::email('email', old('email') , ['class'=>'form-control', 'placeholder'=>'آدرس ایمیل شما', 'required' ] ) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('current_password', ' کلمه عبور کنونی : ', ['class'=>'control-label col-sm-2 pull-right'] ) !!}
                        <div class="col-sm-4">
                            {!! Form::password('current_password' , ['class'=>'form-control', 'placeholder'=>'کلمه عبور کنونی شما ', 'required' ] ) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', ' کلمه عبور جدید : ', ['class'=>'control-label col-sm-2 pull-right'] ) !!}
                        <div class="col-sm-4">
                            {!! Form::password('password' , ['class'=>'form-control', 'placeholder'=>'حداقل 6 کاراکتر ', 'required' ] ) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', ' تکرار کلمه عبور : ', ['class'=>'control-label col-sm-2 pull-right'] ) !!}
                        <div class="col-sm-4">
                            {!! Form::password('password_confirmation' , ['class'=>'form-control', 'placeholder'=>' تکرار کلمه عبور جدید ', 'required' ] ) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    {!! Form::submit('تغییر کلمه عبور', ['class'=>'btn btn-violet']) !!}

                {!! Form::close() !!}


            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
                آخرین به روز رسانی {{ $last_update }}
            </div>
        </div>
    </div>
@endsection