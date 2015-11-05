<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            اعضای گروه
        </div>
        <div class="panel-body">
            <div class="list-item">
                <ul class="">
                    @foreach($group->users as $user)
                        <li>
                            <a class="title" href="{{route('home.profile',[$user->id])}}">{{$user->username}}</a>
                            <div class="date"></div>
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