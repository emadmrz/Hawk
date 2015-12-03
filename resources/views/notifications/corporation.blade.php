<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$corporation->sender_id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$corporation->sender->avatar ) }}" alt="{{ $corporation->sender->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$corporation->sender_id]) }}"> {{ $corporation->sender->username }} </a>
            در مهارت
            <a href="#">{{ $corporation->skill->title }}</a>
            قصد همکاری با شما را دارد .
            <div class="info">
                <span class="date" >{{ $corporation->shamsi_created_at }}</span>&ensp;
                <a href="{{route('profile.corporation.index',[$corporation->id])}}" class="btn btn-info btn-xs">مشاهده جزئیات</a>
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>