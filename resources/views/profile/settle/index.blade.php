@extends('profile.layout')

@section('side')
    @include('partials.settleManagement')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                درخواست های تسویه
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">مبلغ (تومان)</th>
                        <th class="text-right">توضیحات</th>
                        <th class="text-right">وضعیت</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settles as $key=>$settle)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ abs($settle->amount) }}</td>
                            <td>{{$settle->description}}</td>
                            @if($settle->status==0)
                                <td>در حال بررسی</td>
                            @elseif($settle->status==1)
                                <td>پرداخت شده</td>
                            @elseif($settle->status==2)
                                <td>غیر قابل قبول</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $settles->render() !!}</div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection