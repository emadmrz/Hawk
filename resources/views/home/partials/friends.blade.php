@if(count($user->friends()))
<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            دوستان
        </div>
        <div class="panel-body">
            <div class="list-item-image">
                <ul class="">
                    @foreach($user->friends()->take(5) as $friend)
                        <li>
                            <div class="media">
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
        <div class="panel-footer text-center">
            {{--<a class="see-more" href="{{ route('home.articles', [$user->id]) }}"><i class="fa fa-plus fa-1x"></i>مشاهده سایر مقالات</a>--}}
        </div>
    </div>
</div>
@endif