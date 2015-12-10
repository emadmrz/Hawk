{{--<li class="media">--}}
    {{--<div class="media-right">--}}
        {{--<a href="">--}}
            {{--<img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="media-body">--}}
        {{--<a href="{{ route('home.profile', $comment->user_id) }}" class="comment-author pull-right flip">{{ $comment->user->username }}</a>--}}
        {{--<span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>--}}
        {{--<p>{{ $comment->body }}</p>--}}

    {{--</div>--}}
{{--</li>--}}
<li class="media">
    @can('delete-post-comment', [$post, $comment])
    <div class="pull-left">
        {!! Form::open(['route'=>['profile.post.comment.delete', $post->id, $comment->id], 'data-remote-multiple', 'id'=>'delete_post_comment_form']) !!}
        <button class="glass-input" type="submit" ><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}
    </div>
    @endcan
    <div class="comment_like">
        <div class="like ">
            {!! Form::open(['route'=>['api.like.comment'], 'data-remote-multiple', 'id'=>'like_post_comment_form']) !!}
            <span id="num">{{ $comment->num_like }}</span>
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="hidden" name="type" value="1">
            <button class="glass-input" type="submit" ><i class="fa  @if($comment->liked($comment->user_id)) fa-thumbs-up @else fa-thumbs-o-up @endif "></i></button>
            {!! Form::close() !!}
        </div>
        <div class="dislike">
            {!! Form::open(['route'=>['api.like.comment'], 'data-remote-multiple', 'id'=>'dislike_post_comment_form']) !!}
            <input type="hidden" name="id" value="{{ $comment->id }}">
            <input type="hidden" name="type" value="-1">
            <button class="glass-input" type="submit" ><i class="fa @if($comment->disliked($comment->user_id)) fa-thumbs-down @else fa-thumbs-o-down @endif "></i></button>
            <span id="num">{{ $comment->num_dislike }}</span>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="media-right">
        <a href="">
            <img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">
        </a>
    </div>
    <div class="media-body">
        <a href="{{ route('home.profile', $comment->user_id) }}" class="comment-author pull-right flip">{{ $comment->user->username }}</a>
        <span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>
        @can('update-post-comment', $comment)
        <p><a data-post-inline-editable  id="body" data-type="textarea" data-rows="5" data-mode="inline" data-showbuttons="bottom" data-url="{{ route('profile.post.comment.update', [$post->id, $comment->id]) }}" data-pk="{{ $comment->id }}">{{ $comment->body }}</a></p>
        @else
            <p>{{ $comment->body }}</p>
        @endcan

    </div>
</li>