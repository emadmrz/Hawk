@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Create. Date</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Skill Ratings</th>
                            <th>Rate</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="{{route('home.profile',[$user->id])}}">{{$user->username}}</a></td>
                                <td>{{$user->shamsi_created_at}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->roles[0]->name}}</td>
                                <td><a class="btn btn-info" href="{{route('admin.staration.skill',[$user->id])}}">View</a></td>
                                <td>{{$user->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{route('admin.staration.start')}}">Calculate</a>
                    <div class="text-center">{{$users->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
