@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if($profile!=null)
                    <a href="{{route('home.profile',[$profile->id])}}" class="pull-right">{{$profile->username}}</a>
                @endif
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
                                    @if($article->stat==1)
                                        <button class="btn btn-success disabled">active</button>
                                    @endif
                                    @if($article->stat==0)
                                        <button class="btn btn-danger disabled">banned</button>
                                    @endif
                                </td>

                                <td>
                                    <a class="btn btn-info" href="{{route('home.article.preview',[$article->user->id,$article->id])}}">Preview</a>
                                    @if($article->stat==1)
                                        <a href="{{route('admin.article.change',[$article->id])}}" data-post-ban class="btn btn-danger">ban</a>
                                    @elseif($article->stat==0)
                                        <a href="{{route('admin.article.change',[$article->id])}}" data-post-active class="btn btn-primary">active</a>
                                    @endif
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
