<li class="notification">
    <div class="media">
        <div class="media-right">
            <a href="{{ route('home.profile', [$problem->user->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$problem->user->avatar ) }}" alt="{{ $problem->user->username }}"></a>
        </div>
        <div class="media-body">
            <a href="{{ route('home.profile', [$problem->user->id]) }}"> {{ $problem->user->username }} </a>
            <span>پرسش جدیدی در </span> <a href="{{route('group.index',[$problem->parentable->id])}}"> {{$problem->parentable->name}} </a> <span>مطرح کرد .</span>
            <p class="content" ><a href="{{ route('group.problemPreview',[$problem->parentable->id, $problem->id]) }}">"{{ str_limit($problem->content,'70','...') }}"</a></p>
            <div class="info">
                <span class="date" >{{ $problem->shamsi_human_created_at }}</span>&ensp;
                {{--<a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>--}}
                {{--<a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>--}}
            </div>
        </div>
    </div>
</li>