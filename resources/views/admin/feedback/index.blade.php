@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Feedbacks
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <a class="btn btn-details" href="{{route('admin.feedback.show',['cat'=>'all'])}}">All Feeds</a>
                    <a class="btn btn-details" href="{{route('admin.feedback.show',['cat'=>'new'])}}">New Feeds</a>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Link</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($feedbacks as $key=>$feedback)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $feedback->user->username }}</td>
                                <td>{{$feedback->user->roles[0]->name}}</td>
                                <td>{{ $feedback->user->email }}</td>
                                <td><a href="{{$feedback->link}}">{{$feedback->link}}</a></td>
                                <td>{{ $feedback->shamsi_created_at  }}</td>
                                @if($feedback->status==0)
                                    <td><a disabled class="btn btn-warning" href="#">new</a></td>
                                @elseif($feedback->status==1)
                                    <td><a disabled class="btn btn-success" href="#">checked</a></td>
                                @endif
                                @if($feedback->status==0)
                                    <td>
                                        {!! Form::open(['route'=>['admin.feedback.seen',$feedback->id]]) !!}
                                        <button class="btn btn-primary" type="submit">Seen</button>
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($feedback->status==1)
                                    <td>
                                        {!! Form::open(['route'=>['admin.feedback.unseen',$feedback->id]]) !!}
                                        <button class="btn btn-primary" type="submit">UnSeen</button>
                                        {!! Form::close() !!}
                                    </td>

                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{!! $feedbacks->render() !!}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
