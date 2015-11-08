@extends('admin.layout')

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Users Account
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Reg. Date</th>
                        <th>status</th>
                        <th>confirmation</th>
                        <th>actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->first()->name }}</td>
                            <td>{{ $user->shamsi_created_at  }}</td>
                            <td><span class="label label-{{ $user->user_status['type']  }}">{{ $user->user_status['name']  }}</span></td>
                            <td><span class="label label-{{ $user->user_confirmed_status['type']  }}">{{ $user->user_confirmed_status['name']  }}</span></td>
                            <td>
                                <a href="{{ route('admin.admins.edit', ['user'=> $user->id ]) }}" class="btn btn-info btn-sm">edit</a>
                                <a data-delete-confirm href="{{ route('admin.admins.delete', ['user'=> $user->id ]) }}" class="btn btn-danger btn-sm">del</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $users->render() !!}</div>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>

@endsection
