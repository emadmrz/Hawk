<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $poll->user->username }}" src="{{ asset('img/persons/'.$poll->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $poll->user_id) }}">{{ $poll->user->username }}</a>
        ،
        <a href="{{ route('store.poll') }}">افزونه نظرسجنی را</a>
            خریداری کرد.
        <div class="pull-left stream-icon"><i class="fa fa-bar-chart-o fa-2x"></i></div>
    </div>
</div>