@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Articles
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
                        @foreach($articles as $key=>$article)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$article->user->username}}</td>
                                <td>{{$article->shamsi_created_at}}</td>
                                <td>{{str_limit($article->content,20)}}</td>
                                <td>{{$article->user->roles[0]->name}}</td>
                                <td>
                                    @if($article->active==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($article->active==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.article.preview',[$article->user->id,$article->id])}}">Preview</a>
                                    @if($article->active==1)
                                        <a href="{{route('admin.users.article.change',[$user->id,$article->id])}}" data-post-ban class="btn btn-warning">ban</a>
                                    @elseif($article->active==0)
                                        <a href="{{route('admin.users.article.change',[$user->id,$article->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
                                    <a class="btn btn-danger" data-delete-confirm href="{{route('admin.users.article.delete',[$article->user->id,$article->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$articles->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
