@if(count($user->groups))
<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
گروه ها
        </div>
        <div class="panel-body">
            <div class="list-item-image">
                <ul class="">
                    @foreach($user->groups as $group)
                        <li>
                            <div class="media">
                                <div class="media-right">
                                    <a href="{{ route('group.index', [$group->id]) }}"><img class="media-object img-circle" src="{{ asset('img/persons/'.$group->avatar ) }}" alt="{{ $group->name }}"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading"><a href="{{ route('group.index', [$group->id]) }}"> {{ $group->name }} </a></div>
                                    <div class="date">
                                        @if($group->user_id == $user->id)
                                            مدیر گروه
                                        @else
                                            عضو فعال گروه
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer text-center">
            @if($user->id == Auth::user()->id)
                <a class="see-more" href="{{ route('profile.group.list') }}"><i class="fa fa-plus fa-1x"></i>مدیریت گروه های من</a>
            @else
                <a class="see-more" href="{{ route('profile.group.create') }}"><i class="fa fa-plus fa-1x"></i>ساخت گروه جدید</a>
            @endif
        </div>
    </div>
</div>
@endif