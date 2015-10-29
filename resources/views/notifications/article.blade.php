<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$article->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$article->user->avatar ) }}" alt="{{ $article->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$article->user->id]) }}"> {{ $article->user->username }} </a>
                مقاله جدید منتشر کرد.
            <p class="content" ><a href="{{ route('home.article.preview',[$article->user_id, $article->id]) }}">"{{ $article->title }}"</a></p>
            <div class="info">
                <span class="date" >{{ $article->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>