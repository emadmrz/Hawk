<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $offer->user->username }}" src="{{ asset('img/persons/'.$offer->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $offer->user_id) }}">{{ $offer->user->username }}</a>
        ،
        <a href="{{ route('store.offer') }}">افزونه پیشنهاد ویژه را </a>
        خریداری کرد.
        <div class="pull-left stream-icon"><i class="fa fa-bar-chart-o fa-2x"></i></div>
    </div>
</div>