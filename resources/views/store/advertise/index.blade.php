@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت افزونه تبلیغات در صفحه اول
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">نوع</th>
                        <th width="20%" class="text-right">تاریخ خرید</th>
                        <th width="20%" class="text-right">تاریخ انتقضا</th>
                        <th width="10%" class="text-right">وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($advertises as $key=>$advertise)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ Config::get('addonAdvertise.attributes')[1]['values'][$advertise->type]['name'] }}</td>
                            <td>{{ $advertise->shamsi_created_at }}</td>
                            <td>{{ $advertise->shamsi_expired_at }}</td>
                            <td>
                                @if($advertise->status == 0)
                                    <span class="label label-danger">پرداخت ناموفق و عدم اعمال</span>
                                @elseif($advertise->status == 1)
                                    @if($advertise->is_expired == 0)
                                        <span class="label label-success">فعال</span>
                                    @elseif($advertise->is_expired == 1)
                                        <span class="label label-warning">منقضی</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection