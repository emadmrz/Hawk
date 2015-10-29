<div class="stream store">
    <div class="user">
        <img data-toggle="tooltip" data-placement="bottom" title="{{ $questionnaire->user->username }}" src="{{ asset('img/persons/'.$questionnaire->user->avatar) }}">
    </div>
    <div class="title">
        <a href="{{ route('home.profile', $questionnaire->user_id) }}">{{ $questionnaire->user->username }}</a>
        ،
        <a href="{{ route('store.poll') }}">افزونه پرسشنامه</a>
را            خریداری کرد.
        <div class="pull-left stream-icon"><i class="fa fa-hand-pointer-o fa-2x"></i></div>
    </div>
</div>