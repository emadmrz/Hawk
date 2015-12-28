@extends('admin.layout')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route('home.profile',[$user->id])}}" class="pull-right">{{$user->username}}</a>
                Comments
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Content</th>
                            <th>Likes</th>
                            <th>DisLikes</th>
                            <th>Create. Date</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $key=>$comment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{str_limit($comment->body,20)}}</td>
                                <td>{{ $comment->num_like }}</td>
                                <td>{{ $comment->num_dislike }}</td>

                                <td>{{$comment->shamsi_created_at}}</td>
                                <td>
                                    @if($comment->commentable_type=='App\Post')
                                        <a class="btn btn-info" href="{{route('home.post.preview',[$comment->commentable->user->id,$comment->commentable->id])}}">Preview</a>
                                    @elseif($comment->commentable_type=='App\Article')
                                        <a class="btn btn-info" href="{{route('home.article.preview',[$comment->commentable->user->id,$comment->commentable->id])}}">Preview</a>
                                    @elseif($comment->commentable_type=='App\Addon')
                                        <a class="btn btn-info" href="{{route('store.'.$comment->commentable->name)}}">Preview</a>
                                    @elseif($comment->commentable_type=='App\Product')
                                        <a class="btn btn-info" href="{{route('home.shop.product',[$comment->commentable->shop->id,$comment->commentable->id])}}">Preview</a>
                                    @endif
                                    <a class="btn btn-danger" data-delete-confirm href="{{route('admin.users.comment.delete',[$user->id,$comment->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">{{$comments->render()}}</div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->


        </div>
    </div>

@endsection
