<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$endorse->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$endorse->user->avatar ) }}" alt="{{ $endorse->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$endorse->user->id]) }}"> {{ $endorse->user->username }} </a>
                ، مهارت
            <a href="#">{{ $endorse->skill->title }}</a>
            از
            @if($endorse->skill->user_id == $user->id)
                شما
            @else
                <a href="{{ route('home.profile', [$endorse->skill->user_id]) }}"> {{ $endorse->skill->user->username }} </a>
            @endif
            را تایید کرد.
            <div class="info">
                <span class="date" >{{ $endorse->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>