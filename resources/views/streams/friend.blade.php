<div class="stream friendship">
    <div class="sender">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $friend->sender->username }}" src="{{ asset('img/persons/'.$friend->sender->avatar) }}">
    </div>
    <div class="receiver">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $friend->receiver->username }}" src="{{ asset('img/persons/'.$friend->receiver->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $friend->sender_id) }}">{{ $friend->sender->username }}</a>
        و
        <a href="{{ route('home.profile', $friend->receiver_id) }}">{{ $friend->receiver->username }}</a>
        با یکدیگر دوست شدند.
    </div>
</div>