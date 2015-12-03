<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$message->first()->friend_info->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$message->first()->friend_info->avatar ) }}" alt="{{ $message->first()->friend_info->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$message->first()->friend_info->id]) }}"> {{ $message->first()->friend_info->username }} </a>
            <p class="content" ><a href="{{ route('chat.index',[$message->first()->friend_info->id]) }}">"{{ str_limit($message->first()->latestMessage,'70','...') }}"</a></p>
            <div class="info">
                <span class="date" >{{ $message->first()->latestHumanCreatedAt }}</span>&ensp;
            </div>
        </div>
    </div>
</li>