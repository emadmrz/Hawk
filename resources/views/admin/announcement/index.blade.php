@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Announcement
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Creator</th>
                            <th>content</th>
                            <th>Expire. Date</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($announcements as $key=>$announcement)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$announcement->user->username}}</td>
                                <td>{{$announcement->content}}</td>
                                <td>{{$announcement->shamsi_expired_at}}</td>
                                <td>{{$announcement->shamsi_created_at}}</td>
                                <td>
                                    @if($announcement->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($announcement->active==0)
                                        <button class="btn btn-warning disabled">disabled</button>
                                    @endif
                                </td>
                                <td>
                                    @if($announcement->active==0)
                                        <a href="{{route('admin.announcement.change',[$announcement->id])}}" class="btn btn-success" data-post-active>activate</a>
                                    @elseif($announcement->active==1)
                                        <a href="{{route('admin.announcement.change',[$announcement->id])}}" class="btn btn-warning" data-post-ban>Ban</a>
                                    @endif
                                        <a href="{{route('admin.announcement.edit',[$announcement->id])}}" class="btn btn-info">Edit</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$announcements->render()}}</div>
                </div>
                <!-- /.table-responsive -->
                <div class="col-sm-5">
                    <a class="btn btn-primary" href="{{route('admin.announcement.create')}}">Create Announcement</a>
                </div>
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
