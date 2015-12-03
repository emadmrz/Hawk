<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$corporation->receiver_id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$corporation->receiver->avatar ) }}" alt="{{ $corporation->receiver->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$corporation->receiver_id]) }}"> {{ $corporation->receiver->username }} </a>
            تقاضای شما برای همکاری در زمینه
            <a href="#">{{ $corporation->skill->title }}</a>
            را پذیرفت .
            <div class="info">
                <span class="date" >{{ $corporation->shamsi_updated_at }}</span>&ensp;
                <a href="{{route('profile.corporation.question.index',[$corporation->id])}}" class="btn btn-info btn-xs">تکمیل پرسشنامه</a>
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>