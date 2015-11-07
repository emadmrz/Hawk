<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">تسویه</div>
        <div class="panel-body side-nav-menu">
            <ul class="">
                <li>{{$amount}}</li>
                <li><a class="btn btn-success @if(!$settle['canSettle']) disabled @endif" href="{{route('profile.management.settle.create')}}">تسویه</a></li>
                @if($settle['canSettle'])
                    <li class="alert-success">{{$settle['message']}}</li>
                @else
                    <li class="alert-danger">{{$settle['message']}}</li>
                @endif
            </ul>
            <span>
                <li>نزدیکترین زمان تسویه :</li>
                <li><span>{{$settle['time']}}</span></li>
            </span>
        </div>
    </div>
</div>