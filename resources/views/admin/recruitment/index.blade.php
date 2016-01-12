@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Recruitments
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Group Title</th>
                            <th>Job Title</th>
                            <th>Create. Date</th>
                            <th>Expire. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recruitments as $key=>$recruitment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$recruitment->group_title}}</td>
                                <td>{{$recruitment->job_title}}</td>
                                <td>{{$recruitment->shamsi_created_at}}</td>
                                <td>{{$recruitment->shamsi_expired_at}}</td>
                                <td>
                                    @if($recruitment->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @elseif($recruitment->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @elseif($recruitment->status==2)
                                        <button class="btn btn-success disabled">Ready</button>
                                    @endif
                                    @if($recruitment->active==1)
                                        <button class="btn btn-success disabled">Published</button>
                                    @elseif($recruitment->active==0)
                                        <button class="btn btn-warning disabled">not Confirmed</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="">Preview</a>
                                    @if($recruitment->active==1)
                                        <a href="{{route('admin.users.recruitment.change',[$user->id,$recruitment->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($recruitment->active==0)
                                        <a href="{{route('admin.users.recruitment.change',[$user->id,$recruitment->id])}}" data-post-active class="btn btn-primary">Confirm</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$recruitments->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
