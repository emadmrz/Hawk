@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                create admin
            </div>

            <div class="panel-body">

                {!! Form::model(['action'=>'Admin\AdminController@store']) !!}
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name ' ) !!}
                            {!! Form::text('first_name', null , ['class'=>'form-control', 'required' ] ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name ' ) !!}
                            {!! Form::text('last_name', null , ['class'=>'form-control', 'required' ] ) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email Address ' ) !!}
                            {!! Form::text('email', null , ['class'=>'form-control','required'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'password ' ) !!}
                            {!! Form::text('password', null , ['class'=>'form-control','id'=>'password','required'] ) !!}
                            <a onclick="show()" style="margin-top: 10px;" href="#" class="btn btn-default btn-sm">Generate</a>
                        </div>


                    </div>
                    <div class="col-sm-4">

                    </div>

                    <div class="col-lg-12">
                        {!! Form::submit('create', ['class'=>'btn btn-primary']) !!}
                        <a href="{{ route('admin.users.list') }}">{!! Form::button('Cancel', ['type'=>'button',
                            'class'=>'btn btn-default']) !!}</a>
                    </div>

                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
@stop
@section('script')
    {{--created by Dara on 5/9/2015
          --password generator
        --}}
        <script>
            function randomPassword()
            {
              chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
              pass = "";
              for(x=0;x<8;x++)
              {
                i = Math.floor(Math.random() * 62);
                pass += chars.charAt(i);
              }
              return pass;
            }
            function show(){
                document.getElementById("password").value=randomPassword();
            }
        </script>
@stop