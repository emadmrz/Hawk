<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$recommendation->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$recommendation->user->avatar ) }}" alt="{{ $recommendation->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$recommendation->user->id]) }}"> {{ $recommendation->user->username }} </a>
                ، برای مهارت
            <a href="#">{{ $recommendation->skill->title }}</a>
            از
            @if($recommendation->skill->user_id == $user->id)
                شما
            @else
                <a href="{{ route('home.profile', [$recommendation->skill->user_id]) }}"> {{ $recommendation->skill->user->username }} </a>
            @endif
            توصیه نامه ای نوشت.
            <div class="info">
                <span class="date" >{{ $recommendation->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>