<div class="timeline-block">
    <div class="panel panel-default">
        <div class="panel-heading post-heading">

            <div class="media">
                <div class="media-right">
                    <a href="">
                        <img src="{{ asset('/img/persons/'.$post->user->avatar) }}" title="{{ $post->user->username }}" class="media-object">
                    </a>
                </div>
                <div class="media-body">
                    <a href="{{ route('home.profile', $post->user->id) }}">{{ $post->user->username }}</a>
                    <span class="date" >شنبه 2 مهرماه 1395</span>
                </div>
            </div>

        </div>
        <div class="panel-body post-content">
            <div class="row">
                <div class="col-sm-4 pull-right  image">
                    <img src="{{ $post->image }}" class="img-rounded">
                </div>
                <div class="col-sm-8 pull-right">
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
        <div class="view-all-comments">
            <a href="#" class="pull-right">
                <i class="fa fa-comments-o"></i>
            </a>
            @if(count($post->comments))
                <span>{{ $post->num_comment }} دیدگاه</span>
            @else
                <span>اولین نفری باشد که دیدگاهتان را ثبت می کنید.</span>
            @endif

        </div>
        <ul class="comments" id="post_comments_list">
            <div class="list" data-nicescroll>
                @foreach($post->comments->reverse() as $comment)
                    <li class="media">
                        @can('delete-post-comment', [$post, $comment])
                            <div class="pull-left">
                                {!! Form::open(['route'=>['profile.post.comment.delete', $post->id, $comment->id], 'data-remote-multiple', 'id'=>'delete_post_comment_form']) !!}
                                    <button class="glass-input" type="submit" ><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </div>
                        @endcan
                        <div class="media-right">
                            <a href="">
                                <img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="" class="comment-author pull-right flip">{{ $comment->user->username }}</a>
                            <span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>
                            @can('update-post-comment', $comment)
                                <p><a data-post-inline-editable  id="body" data-type="textarea" data-rows="5" data-mode="inline" data-showbuttons="bottom" data-url="{{ route('profile.post.comment.update', [$post->id, $comment->id]) }}" data-pk="{{ $comment->id }}">{{ $comment->body }}</a></p>
                            @else
                                <p>{{ $comment->body }}</p>
                            @endcan

                        </div>
                    </li>
                @endforeach
            </div>
            <li class="comment-form">
                {!! Form::open(['route'=>['profile.post.comment.add', $post->id], 'data-remote-multiple', 'id'=>'insert_post_comment_form']) !!}
                <div class="input-group ltr">
                    <input type="text" name="body" class="form-control rtl">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-grey"><i class="fa fa-paper-plane-o"></i></button>
                    </span>
                </div>
                {!! Form::close() !!}
            </li>

        </ul>
    </div>
</div>