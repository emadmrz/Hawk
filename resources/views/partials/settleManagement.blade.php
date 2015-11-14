<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">تسویه کیف پول</div>
        <div class="panel-body settlement-panel">
            <p> موجودی حساب : {{ number_format($amount) }} تومان </p>
            <p> نزدیکترین زمان تسویه :   {{$settle['time']}}</p>
            @if($settle['canSettle'])
                <div class="alert alert-success"> {{$settle['message']}}</div>
            @else
                <div class="alert alert-danger"> {{$settle['message']}}</div>
            @endif
            <a class="btn btn-success btn-block @if(!$settle['canSettle']) disabled @endif" href="{{route('profile.management.settle.create')}}"><i class="fa icon-wallet"></i> درخواست تسویه کیف پول  </a>
        </div>
        <div class="panel-footer text-center">
            <a class="see-more" href="{{ route('profile.management.settle.index') }}"><i class="fa fa-plus fa-1x"></i>  لیست درخواست های تسویه </a>
        </div>
    </div>
</div>