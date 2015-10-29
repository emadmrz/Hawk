<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $shop->user->username }}" src="{{ asset('img/persons/'.$shop->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $shop->user_id) }}">{{ $shop->user->username }}</a>
        ،
        <a href="{{ route('store.poll') }}">افزونه فروشگاه ساز</a>
را            خریداری کرد.
        <div class="pull-left stream-icon"><i class="fa fa-shopping-cart fa-2x"></i></div>
    </div>
</div>