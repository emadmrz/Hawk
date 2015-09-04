@extends('admin.layout')

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit User
        </div>

        <div class="panel-body">

            {!! Form::model($user, ['route' => ['admin.users.update',$user->id ], 'method'=>'put']) !!}
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
                        {!! Form::label('email', 'Emad Address (Non-editable)' ) !!}
                        {!! Form::text('email', null , ['class'=>'form-control', 'disabled' ] ) !!}
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::label('status', 'Status' ) !!}
                                {!! Form::select('status', [0=>'Deactive' , 1=>'Active'], null, ['class'=>'form-control' ] ) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('confirmed', 'Email Confirmation' ) !!}
                                {!! Form::select('confirmed', [0=>'Not Confirmed' , 1=>'Confirmed'], null, ['class'=>'form-control' ] ) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::label('created_at', 'Registration Date' ) !!}
                                {!! Form::text('created_at', null, ['class'=>'form-control', 'disabled' ] ) !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Form::label('updated_at', 'Last Edit Date' ) !!}
                                {!! Form::text('updated_at', null, ['class'=>'form-control', 'disabled' ] ) !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Form::label('user_role_name', 'Role' ) !!}
                                {!! Form::text('user_role_name', null, ['class'=>'form-control', 'disabled' ] ) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>

                <div class="col-lg-12">
                    {!! Form::submit('Edit', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ route('admin.users.list') }}" >{!! Form::button('Cancel', ['type'=>'button', 'class'=>'btn btn-default']) !!}</a>
                </div>

            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>

@endsection


