<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$showcase->user_id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$showcase->user->avatar ) }}" alt="{{ $showcase->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$showcase->user_id]) }}"> {{ $showcase->user->username }} </a>
             درخواست تبلیغ در پروفایل شما را دارد.
            <br><a class="btn btn-info btn-xs" href="{{ route('profile.management.addon.showcase.requestToMe')}}">مشاهده لیست درخواست ها</a>
            <div class="info">
                <span class="date" >{{ $showcase->shamsi_human_updated_at }}</span>&ensp;
            </div>
        </div>
    </div>
</li>