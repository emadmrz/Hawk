@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                درخواست های منتظر تایید دوستی
            </div>
            <div class="panel-body" id="friendship_list">
                <div class="list-item-image">
                    <ul class="">
                        @foreach($friendRepository->myRequestsToOthers() as $friend)
                            <li>
                                <div class="media">
                                    <button class="btn btn-danger btn-xs pull-left" id="delete_friend" data-value="{{ $friend->id }}"><i class="fa fa-user-times"></i> لغو درخواست </button>
                                    <div class="media-right">
                                        <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$friend->friend_info->avatar ) }}" alt="{{ $friend->friend_info->username }}"></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading"><a href="{{ route('home.profile', [$friend->friend_info->id]) }}"> {{ $friend->friend_info->username }} </a></div>
                                        <div class="date">{{ $friend->shamsi_human_created_at }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>

            </div>
        </div>
    </div>
@endsection                                                                                                                                                                                                                                                                                                                                            