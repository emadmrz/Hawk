<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$comment->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$comment->user->avatar ) }}" alt="{{ $comment->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$comment->user->id]) }}"> {{ $comment->user->username }} </a>
            دیدگاهی برای پست شما نوشت.
            <p class="content" ><a href="{{ route('group.post.preview',[$post->parentable->id, $post->id]) }}">"{{ str_limit($comment->body,'60','...') }}"</a></p>
            <div class="info">
                <span class="date" >{{ $comment->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>