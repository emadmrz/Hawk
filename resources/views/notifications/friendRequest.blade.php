<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$user->avatar ) }}" alt="{{ $user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$user->id]) }}"> {{ $user->username }} </a> {{ $message }}
            <div class="info">
                <span class="date" >هم اکنون</span>&ensp;
            </div>
        </div>
    </div>
</li>