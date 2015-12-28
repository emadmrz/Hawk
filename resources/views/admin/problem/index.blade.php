@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Problems
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
                            <th>Group</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($problems as $key=>$problem)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$problem->user->username}}</td>
                                <td>{{$problem->shamsi_created_at}}</td>
                                <td>{{str_limit($problem->content,20)}}</td>
                                <td><a href="{{route('group.index',[$problem->parentable->id])}}">{{$problem->parentable->name}}</a></td>
                                <td>
                                    @if($problem->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($problem->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('group.problemPreview',[$problem->parentable->id,$problem->id])}}">Preview</a>
                                    @if($problem->active==1)
                                        <a href="{{route('admin.users.problem.change',[$user->id,$problem->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($problem->active==0)
                                        <a href="{{route('admin.users.problem.change',[$user->id,$problem->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                    <a class="btn btn-danger" data-delete-confirm href="{{route('admin.users.problem.delete',[$problem->user->id,$problem->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$problems->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
