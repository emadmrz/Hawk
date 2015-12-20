<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $showcase->user->username }}" src="{{ asset('img/persons/'.$showcase->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $showcase->user_id) }}">{{ $showcase->user->username }}</a>
        ،
       افزونه تبلیغات در پروفایل
        <a href="{{ route('home.profile', $showcase->profile_id) }}"> {{ $showcase->profile->username }} </a>
 را خریداری کرد.
        <div class="pull-left stream-icon"><i class="fa fa-bar-chart-o fa-2x"></i></div>
    </div>
</div>