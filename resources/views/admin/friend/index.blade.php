@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Friends
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($friends as $key=>$friend)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$friend->friend_info->username}}</td>
                                <td>{{$friend->friend_info->email}}</td>
                                <td>{{$friend->shamsi_created_at}}</td>
                                <td>
                                    @if($friend->status==0)
                                        <button class="btn btn-primary disabled">Waiting</button>
                                    @elseif($friend->status==1)
                                        <button class="btn btn-success disabled">Friend</button>
                                    @elseif($friend->status==2)
                                        <button class="btn btn-warning disabled">Cancelled</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.profile',[$friend->friend_info->id])}}">Show Profile</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
