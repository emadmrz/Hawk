<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$post->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$post->user->avatar ) }}" alt="{{ $post->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$post->user->id]) }}"> {{ $post->user->username }} </a>
            <span>پست جدیدی در </span> <a href="{{route('group.index',[$post->parentable_id])}}"> {{$post->parentable->name}} </a> <span>قرار داد .</span>
            <p class="content" ><a href="{{ route('group.post.preview',[$post->parentable_id, $post->id]) }}">"{{ str_limit($post->content,'70','...') }}"</a></p>
            <div class="info">
                <span class="date" >{{ $post->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>