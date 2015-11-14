@extends('profile.layout')

@section('side')
    @include('partials.settleManagement')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت کیف پول
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">مبلغ (تومان)</th>
                        <th class="text-right">نوع</th>
                        <th class="text-right">تاریخ</th>
                        <th class="text-right">توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($credits as $key=>$credit)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td class="ltr text-right">{{ number_format($credit->amount) }}</td>
                            <td>{{ $credit->operation }}</td>
                            <td>{{ $credit->shamsi_created_at }}</td>
                            <td>{{$credit->description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $credits->render() !!}</div>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
                موجودی کیف پول شما : {{ number_format($cash) }} تومان
            </div>
        </div>
    </div>
@endsection