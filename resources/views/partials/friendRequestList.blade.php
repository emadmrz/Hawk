@if(count($friendRepository->requestsToMe()))
    @foreach($friendRepository->requestsToMe() as $friend)
        <li>
            <div class="media">
                <div class="media-right">
                    <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$friend->friend_info->avatar ) }}" alt="{{ $friend->friend_info->username }}"></a>
                </div>
                <div class="media-body">
                    <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"> {{ $friend->friend_info->username }} </a> درخواست دوستی با شما دارد.
                    <div class="info">
                        <span class="date" >{{ $friend->shamsi_human_created_at }}</span>&ensp;
                        <a class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"> تایید دوستی </a>
                        <a class="btn btn-danger btn-xs" id="delete_friend" data-value="{{ $friend->id }}"> لغو دوستی</a>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@else
    <li>
        <div class="media">
            <div class="media-body text-center find-friend-dropdown">
                <div class="fa fa-frown-o fa-5x"></div>
                <h3>در Skillema تنها نباشید</h3>
                <h5>همین حالا دوستان جدید پیدا کنید</h5>
                <a href="{{route('profile.friends.search')}}" class="btn btn-violet">یافتن دوستان جدید</a>

            </div>
        </div>
    </li>
@endif