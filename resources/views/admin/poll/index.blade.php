@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Polls
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Question</th>
                            <th>Description</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($polls as $key=>$poll)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$poll->title}}</td>
                                <td>{{$poll->question}}</td>
                                <td>{{$poll->description}}</td>
                                <td>{{$poll->shamsi_created_at}}</td>
                                <td>
                                    @if($poll->status==0)
                                        <button class="btn btn-warning disabled">Not Purchased</button>
                                    @elseif($poll->status==1)
                                        <button class="btn btn-primary disabled">Paid</button>
                                    @elseif($poll->status==2)
                                        <button class="btn btn-success disabled">Published</button>
                                    @endif
                                    @if($poll->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @elseif($poll->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('home.poll.preview',[$user->id,$poll->id])}}">Preview</a>
                                    @if($poll->active==1)
                                        <a href="{{route('admin.users.poll.change',[$user->id,$poll->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($poll->active==0)
                                        <a href="{{route('admin.users.poll.change',[$user->id,$poll->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$polls->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
