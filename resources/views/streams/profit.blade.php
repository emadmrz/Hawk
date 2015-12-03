<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $profit->user->username }}" src="{{ asset('img/persons/'.$profit->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $profit->user_id) }}">{{ $profit->user->username }}</a>
        ،
        <a href="{{ route('store.profit') }}">افزایش رتبه برای جستجو</a>
        خود را به
        @if($profit->type==1)
            طلایی
        @elseif($profit->type==2)
            نقره ای
        @elseif($profit->type==3)
            برنزی
        @endif
        ارتقا داد .
        <div class="pull-left stream-icon"><i class="fa fa-database fa-2x"></i></div>
    </div>
</div>