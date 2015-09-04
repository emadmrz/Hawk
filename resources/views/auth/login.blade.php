@extends('auth.layout')

@section('content')
    <div class="login-box">
        @if($errors->any())
            <div class="alerts-box">
                <div class="alert alert-danger animated fadeInDown alert-dismissable" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <ul class="">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                </div>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center logo">
                    <img src="{{ asset('img/logo/skillema_dark.png') }}">
                </div>
                {!! Form::open(['url'=>'auth/login', 'method'=>'post', 'id'=>'login-form', 'class'=>'form-horizontal', 'data-toggle'=>'validator', 'data-disable'=>'false', 'role'=>'form', 'data-delay'=>'5000' ]) !!}
                    <div class="form-group  input-field">
                        {{--<label for="inputEmail3" class="col-xs-3 control-label"> آدرس ایمیل</label>--}}
                        {!! Form::label('email', 'آدرس ایمیل', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            {!! Form::email('email', old('email') , ['class'=>'form-control en', 'placeholder'=>'Email Address...', 'required' ] ) !!}
                        </div>
                    </div>

                    <div class="form-group input-field">
                        {!! Form::label('password', 'کلمه عبور', ['class'=>'col-xs-3 control-label'] ) !!}
                        <div class="col-xs-9">
                            <div class="input-group ltr">
                                {!! Form::password('password', ['class'=>'form-control en', 'placeholder'=>'password...', 'required' ] ) !!}
                                <a href="{{ url('password/email') }}" class="add-on input-group-addon reset-password" data-container="body" data-toggle="tooltip" data-placement="left" title='فراموشی کلمه عبور' >
                                    <i class="fa icon-information fa-lg" ></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-8">
                            <div class="checkbox checkbox-success">
                                {!! Form::checkbox('remember', null, false, ['id'=>'remember'] ) !!}
                                {!! Form::label('remember', 'من را به خاطر بسپار' ) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group  last">
                        <div class="col-xs-12 ">
                            {!! Form::button('ورود به سایت' , ['type'=>'submit', 'class'=>'btn btn-violet btn-block'] ) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
            <div class="panel-footer">
                آیا تا کنون عضو نشده اید ؟ <a href="{{ url('auth/register') }}">  پس همین حالا عضو شوید  </a></div>
        </div>
    </div>
@endsection

@include('partials.copyright')

@section('script')

    <script>
        $(document).ready(function(){
            $('#login-form').validator().on('submit', function (e) {
                if (e.isDefaultPrevented()) {
                    if(!$('.notify-alert').length){
                        $.notify('{{ trans('auth.loginInappropriate')  }}', {type:'danger'});
                    }

                } else {
                    // everything looks good!
                }
            })
        });
    </script>

@endsection