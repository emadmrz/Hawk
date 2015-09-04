@extends('auth.layout')

@section('content')
    <style>
        .site-login{
            overflow-y: scroll;
        }
    </style>
    <div class="text-center logo register">
        <img src="{{ asset('img/logo/skillema.png')  }}">
        <h3>یک سفر هزار مایلی با اولین قدم شروع می شود</h3>
    </div>
    <div class="register-box">
        <div class="panel panel-default">
            <div class="panel-heading text-right">
                <span class="glyphicon glyphicon-user fa-lg"></span> عضویت در سایت   </div>
            <div class="panel-body">
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                {!! Form::open(['url'=>'auth/register', 'method'=>'post', 'id'=>'registration-form', 'class'=>'form-horizontal', 'data-toggle'=>'validator', 'data-disable'=>'false', 'role'=>'form', 'data-delay'=>'2000' ]) !!}
                    <div class="form-group input-field">
                        {!! Form::label('first_name', 'نام', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            {!! Form::text('first_name', old('first_name') , ['class'=>'form-control', 'required', 'data-autodirect' ] ) !!}
                        </div>
                    </div>
                    <div class="form-group input-field">
                        {!! Form::label('last_name', 'نام خانوادگی', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            {!! Form::text('last_name', old('last_name') , ['class'=>'form-control', 'required', 'data-autodirect' ] ) !!}
                        </div>
                    </div>
                    <div class="form-group  input-field">
                        {!! Form::label('email', 'آدرس ایمیل', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            {!! Form::email('email', old('email') , ['class'=>'form-control en',  'required' ] ) !!}
                        </div>
                    </div>
                    <div class="form-group input-field ltr">
                        {!! Form::label('password', 'کلمه عبور', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            {!! Form::password('password', ['class'=>'form-control en', 'data-toggle'=>'password', 'data-minlength'=>'6', 'required' ] ) !!}
                        </div>
                    </div>
                    <div class="form-group radio-box radio-info">
                        {!! Form::label('radio1', 'نوع کاربر', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            <div class="radio radio-inline" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="توضیحی درباره کاربران حقوقی در همین اندازه">
                                {!! Form::radio('role', '2', null, ['id'=>'radio1', 'required']) !!}
                                {!! Form::label('radio1', 'کاربر حقیقی', ['class'=>'control-label'] ) !!}
                            </div>
                            <div class="radio radio-inline" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="توضیح مختصری درباره کاربران حقوقی در همین اندازه">
                                {!! Form::radio('role', '3', null, ['id'=>'radio2', 'required']) !!}
                                {!! Form::label('radio2', 'کاربر حقوقی', ['class'=>'control-label'] ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center" >کلیک کردن بر روی پیوستن به ما بدین معنی است که شما <a href="{{url('about/agreement')}}">شرایط و ضوابط فعالیت در سایت</a> را مطالعه کرده و پذیرفته اید.</div>
                    </div>
                    <div class="form-group  last">
                        <div class="col-xs-12 ">
                            <button type="submit" class="btn btn-violet btn-block">پیوستن به ما</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer">
                آیا قبلا به ما پیوسته اید ؟ <a href="{{url('auth/login')}}">  وارد حساب کاربری خود شوید  </a></div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('input[type="password"]').tooltip({placement:'left', trigger: 'focus', title:'حداقل 6 کاراکتر'});

            $('#registration-form').validator().on('submit', function (e) {
                if (e.isDefaultPrevented()) {
                    if(!$('.notify-alert').length){
                        $.notify('{{ trans('auth.registerInappropriate')  }}', {type:'danger'});
                    }
                } else {
                    // everything looks good!
                }
            });

        })

    </script>
@endsection