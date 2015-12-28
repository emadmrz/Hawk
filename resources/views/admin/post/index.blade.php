@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Posts
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
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key=>$post)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$post->user->username}}</td>
                                <td>{{$post->shamsi_created_at}}</td>
                                <td>{{str_limit($post->content,20)}}</td>
                                <td>{{$post->user->roles[0]->name}}</td>
                                <td>
                                    @if($post->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($post->active==0)
                                            <button class="btn btn-danger disabled">banned</button>
                                        @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.post.preview',[$post->user->id,$post->id])}}">Preview</a>
                                    @if($post->active==1)
                                        <a href="{{route('admin.users.post.change',[$user->id,$post->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($post->active==0)
                                        <a href="{{route('admin.users.post.change',[$user->id,$post->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                    <a class="btn btn-danger" data-delete-confirm href="{{route('admin.users.post.delete',[$post->user->id,$post->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$posts->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
