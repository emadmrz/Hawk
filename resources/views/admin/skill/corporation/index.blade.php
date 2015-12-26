@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.skill.preview',[$user->id,$skill->id])}}" class="pull-right">{{$skill->title}}</a>
                Corporations
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Create. Date</th>
                            <th>Status</th>
                            <th>Form Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($corporations as $key=>$corporation)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="{{route('home.profile',[$corporation->sender->id])}}">{{$corporation->sender->username}}</a></td>
                                <td><a href="{{route('home.profile',[$corporation->receiver->id])}}">{{$corporation->receiver->username}}</a></td>
                                <td>{{$corporation->shamsi_created_at}}</td>
                                <td>
                                    @if($corporation->status==0)
                                        <button class="btn btn-primary disabled">Waiting</button>
                                    @elseif($corporation->status==1)
                                        <button class="btn btn-success disabled">Confirmed</button>
                                    @elseif($corporation->status==2)
                                        <button class="btn btn-warning disabled">Cancelled</button>
                                    @endif
                                </td>
                                <td>
                                    @if($corporation->question_completed==1)
                                        <button class="btn btn-success disabled">Completed</button>
                                    @else
                                        <button class="btn btn-warning disabled">UnCompleted</button>
                                    @endif
                                </td>



                                <td>
                                    @if($corporation->question_completed==1)
                                    <a class="btn btn-info" href="{{route('admin.users.skill.corporation.question.index',[$user->id,$skill->id,$corporation->id])}}">Preview</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$corporations->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
