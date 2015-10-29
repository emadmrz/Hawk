<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $storage->user->username }}" src="{{ asset('img/persons/'.$storage->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $storage->user_id) }}">{{ $storage->user->username }}</a>
        ،
        <a href="{{ route('store.storage') }}">حجم پروفایل</a>
        خود را
        {{ $storage->capacity }}
        مگابایت افزایش داد.
        <div class="pull-left stream-icon"><i class="fa fa-database fa-2x"></i></div>
    </div>
</div>