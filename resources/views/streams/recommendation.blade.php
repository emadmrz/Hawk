<div class="stream friendship recommendation ">
    <div class="sender">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $recommendation->user->username }}" src="{{ asset('img/persons/'.$recommendation->user->avatar) }}">
    </div>
    <div class="receiver">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $recommendation->skill->user->username }}" src="{{ asset('img/persons/'.$recommendation->skill->user->avatar) }}">
    </div>
    <div class="title medium">
        <a href="{{ route('home.profile', $recommendation->user_id) }}">{{ $recommendation->user->username }}</a>
        برای مهارت
        <a href="#">{{ $recommendation->skill->title }}</a>
        از
        <a href="{{ route('home.profile', $recommendation->skill->user->id) }}">{{ $recommendation->skill->user->username }}</a>
توصیه نامه ای نوشت.
    </div>
</div>
<div class="recommendation-text">
    <div class="media">
        <div class="media-right">
            <a href="#">
                <img data-toggle="tooltip" data-placement="bottom" title="{{ $recommendation->skill->user->username }}" class="media-object" src="{{ asset('img/persons/'.$recommendation->skill->user->avatar) }}" alt="{{ $recommendation->skill->user->username }}">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{ $recommendation->user->username }} می نویسد : </h4>
            <p>{{ $recommendation->text }}</p>
        </div>
    </div>
</div>