<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $relater->user->username }}" src="{{ asset('img/persons/'.$relater->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $relater->user_id) }}">{{ $relater->user->username }}</a>
        ،
        <a href="{{ route('store.relater') }}">افزایش رتبه برای پروفایل</a>
        خود را به
        @if($relater->type==2)
            طلایی
            @elseif($relater->type==1.5)
            نقره ای
            @elseif($relater->type==1.25)
            برنزی
        @endif
        ارتقا داد .
        <div class="pull-left stream-icon"><i class="fa fa-database fa-2x"></i></div>
    </div>
</div>