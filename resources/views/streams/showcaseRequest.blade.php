<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $showcase->user->username }}" src="{{ asset('img/persons/'.$showcase->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $showcase->user_id) }}">{{ $showcase->user->username }}</a>
         درخواست تبلیغ در پروفایل شما را دارد.
        <div class="pull-left stream-icon"><i class="fa fa-bar-chart-o fa-2x"></i></div>
    </div>
</div>