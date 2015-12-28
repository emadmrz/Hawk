@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Role
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Register. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->roles as $role)
                            <tr>
                                <td>{{$user->username}}</td>
                                <td><button class="btn btn-info disabled">{{$role->slug}}</button></td>
                                <td>{{$user->shamsi_created_at}}</td>
                                <td>
                                    @if($user->status==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($user->status==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$user->id])}}">Preview</a>
                                    <a data-delete-confirm class="btn btn-danger" href="{{route('admin.users.role.delete',[$user->id,$role->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                {!! Form::open(['route'=>['admin.users.role.submit',$user->id]]) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            {!! Form::label('role', 'Role' ) !!}
                            {!! Form::select('role', $roles, null, ['class'=>'form-control'] ) !!}
                        </div>
                    </div>
                </div>
                <div style="padding-left: 0;" class="col-lg-12">
                    {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
