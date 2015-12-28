@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Answers
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
                            <th>Content</th>
                            <th>Question</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($answers as $key=>$answer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$answer->user->username}}</td>
                                <td>{{$answer->shamsi_created_at}}</td>
                                <td>{{$answer->body}}</td>
                                <td>{{$answer->commentable->content}}</td>
                                <td><a href="{{route('group.index',[$answer->commentable->parentable->id])}}">{{$answer->commentable->parentable->name}}</a></td>
                                <td>
                                    @if($answer->id===$answer->commentable->comment_id)
                                        <button class="btn btn-success disabled">Correct</button>
                                    @else
                                        <button class="btn btn-info disabled">inCorrect</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route('group.problemPreview',[$answer->commentable->parentable->id,$answer->commentable->id])}}">Preview</a>
                                    <a data-delete-confirm class="btn btn-danger" href="{{route('admin.users.answer.delete',[$answer->user->id,$answer->id])}}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$answers->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
