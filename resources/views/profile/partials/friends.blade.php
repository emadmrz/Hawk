@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                لیست دوستان و درخواست ها
            </div>
            <div class="panel-body" id="friendship_list">
                <div class="list-item-image">
                    <ul class="">
                        @foreach($friendRepository->myTotalFriends() as $friend)
                            <li>
                                <div class="media">
                                    <button class="btn btn-danger btn-xs pull-left" id="delete_friend" data-value="{{ $friend->id }}">
                                        <i class="fa fa-user-times"></i>
                                        @if($friend->status == 2)
                                            لغو درخواست
                                        @else
                                            لغو دوستی
                                        @endif
                                    </button>
                                    <div class="media-right">
                                        <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$friend->friend_info->avatar ) }}" alt="{{ $friend->friend_info->username }}"></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{ route('home.profile', [$friend->friend_info->id]) }}"> {{ $friend->friend_info->username }} </a>
                                            @if($friend->status == 1)
                                                <label class="label label-success"> دوست </label>
                                            @elseif($friend->status == 2)
                                                <label class="label label-info"> منتظر تایید دوستی </label>
                                            @endif
                                        </div>
                                        <div class="date">
                                            {{ $friend->shamsi_human_created_at }}
                                            @if($friend->status == 2 and $friend->requester == 'me')
                                                - درخواست دوستی از طرف شما
                                            @elseif($friend->status == 2 and $friend->requester == 'other')
                                                - درخواست دوستی به شما
                                            @endif
                                        </div>
                                        @if($friend->status == 2 and $friend->requester == 'other')
                                            <div class="actions">
                                                <button class="btn btn-success btn-xs" id="accept_friend"  data-value="{{ $friend->id }}"><i class="fa fa-hand-peace-o"></i> تایید دوستی </button>
                                            </div>
                                        @endif
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