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
                        <th class="text-right">تاریخ درخواست</th>
                        <th class="text-right">توضیحات</th>
                        <th class="text-right">وضعیت</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settles as $key=>$settle)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ number_format($settle->amount) }}</td>
                            <td>{{ $settle->shamsi_created_at }}</td>
                            <td>{{$settle->description}}</td>
                            <td>
                                @if($settle->status==0)
                                    <span class="label label-warning">در حال بررسی</span>
                                @elseif($settle->status==1)
                                    <span class="label label-success">تسویه شده</span>
                                @elseif($settle->status==2)
                                    <span class="label label-danger">عدم تایید</span>
                                @endif
                            </td>
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