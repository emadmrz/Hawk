<div class="stream friendship ">
    <div class="sender">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $endorse->user->username }}" src="{{ asset('img/persons/'.$endorse->user->avatar) }}">
    </div>
    <div class="receiver">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $endorse->skill->user->username }}" src="{{ asset('img/persons/'.$endorse->skill->user->avatar) }}">
    </div>
    <div class="title medium">
        <a href="{{ route('home.profile', $endorse->user_id) }}">{{ $endorse->user->username }}</a>
        مهارت
        <a href="#">{{ $endorse->skill->title }}</a>
        از
        <a href="{{ route('home.profile', $endorse->skill->user->id) }}">{{ $endorse->skill->user->username }}</a>
        را تایید کرد.
    </div>
</div>