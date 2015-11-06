<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            اعضای گروه
        </div>
        <div class="panel-body">
            <div class="list-item-image">
                <ul class="">
                    @foreach($group->users as $user)
                        <li>
                            <div class="media">
                                <div class="media-right">
                                    <a href="{{route('home.profile',[$user->id])}}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$user->avatar ) }}" alt="{{ $user->username }}"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading"><a href="{{ route('home.profile', [$user->id]) }}"> {{ $user->username }} </a></div>
                                    @if($group->user_id == $user->id)
                                        <div class="date">مدیر گروه</div>
                                    @else
                                        <div class="date">عضو گروه</div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer text-center">

            <a class="see-more" href="#"><i class="fa fa-plus fa-1x"></i>مشاهده تمامی اعضا</a>
        </div>
    </div>
</div>