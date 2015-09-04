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

        @if(Session::has('status'))
            <div class="alerts-box">
                <div class="alert alert-success animated fadeInDown alert-dismissable" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <ul class="">
                        <li>{{ Session::get('status')  }}</li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center logo">
                    <img src="{{ asset('img/logo/skillema_dark.png') }}">
                </div>
                {!! Form::open(['url'=>'password/email', 'method'=>'post', 'id'=>'password-reset-form', 'class'=>'', 'data-toggle'=>'validator', 'data-disable'=>'false', 'role'=>'form' ]) !!}
                    <div class="form-group">
                        {!! Form::label('email', ' آدرس ایمیل عضویت در سایت ', ['class'=>'control-label'] ) !!}
                        {!! Form::email('email', old('email') , ['class'=>'form-control en', 'placeholder'=>'Email Address...', 'required' ] ) !!}
                    </div>

                    <div class="form-group last">
                        <div class="text-center">
                            {!! Form::button('دریافت ایمیل برای تغییر پسورد' , ['type'=>'submit', 'class'=>'btn btn-violet btn-block'] ) !!}
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
            $('#password-reset-form').validator().on('submit', function (e) {
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