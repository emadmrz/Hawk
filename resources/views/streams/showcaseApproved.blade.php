<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $showcase->profile->username }}" src="{{ asset('img/persons/'.$showcase->profile->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $showcase->profile_id) }}">{{ $showcase->profile->username }}</a>
        درخواست تبلیغ شما را تایید کرد.
        <div class="pull-left stream-icon"><i class="fa fa-bar-chart-o fa-2x"></i></div>
    </div>
</div>