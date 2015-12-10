{{--<li class="media">--}}
    {{--<div class="media-right">--}}
        {{--<a href="">--}}
            {{--<img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="media-body">--}}
        {{--<a href="{{ route('home.profile', $comment->user_id) }}" class="comment-author pull-right flip">{{ $comment->user->username }}</a>--}}
        {{--<span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>--}}

            {{--<p>{{$comment->body}}</p>--}}


    {{--</div>--}}
{{--</li>--}}

<li class="media">

    <div class="pull-left">
        @can('delete-problem-comment',[$problem,$comment])
        {!! Form::open(['route'=>['group.problem.comment.delete', $problem->id, $comment->id], 'data-remote-multiple', 'id'=>'delete_post_comment_form']) !!}
        <button class="glass-input" type="submit" ><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}
        @endcan
    </div>
    <div class="pull-left">
        @can('confirm-problem-answer',$problem)
        {!! Form::open(['route'=>['group.problem.answer',$problem->id,$comment->id],'data-remote-multiple','id'=>'confirm_problem_answer_form']) !!}
        <button class="btn btn-sm confirm-answer @if($problem->comment_id==$comment->id) btn-success @endif" type="submit"><i class="fa fa-check"></i></button>
        {!! Form::close() !!}
        @else
            @if($problem->comment_id==$comment->id)
                <span class="btn btn-success disabled">جواب صحیح</span>
            @endif
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
    </div>
    <div class="media-right">
        <a href="">
            <img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">
        </a>
    </div>
    <div class="media-body">
        <a href="{{ route('home.profile', $comment->user_id) }}" class="comment-author pull-right flip">{{ $comment->user->username }}</a>
        <span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>
        @can('update-problem-comment',[$comment])
        <p><a data-post-inline-editable  id="body" data-type="textarea" data-rows="5" data-mode="inline" data-showbuttons="bottom" data-url="{{ route('group.problem.comment.update', [$problem->id, $comment->id]) }}" data-pk="{{ $comment->id }}">{{ $comment->body }}</a></p>
        @else
            <p>{{$comment->body}}</p>
            @endcan


    </div>
</li>