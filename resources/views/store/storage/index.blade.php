@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت تراکنش های بانکی
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">افزایش حجم (MB)</th>
                        <th width="20%" class="text-right">مبلغ (تومان)</th>
                        <th width="20%" class="text-right">تاریخ</th>
                        <th width="5%" class="text-right">وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($storages as $key=>$storage)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $storage->capacity }}</td>
                            <td>{{ number_format($storage->payment->amount) }}</td>
                            <td>{{ $storage->shamsi_created_at }}</td>
                            <td>
                                @if($storage->status)
                                    <span class="label label-success">پرداخت موفق و اعمال حجم</span>
                                @else
                                    <span class="label label-danger">پرداخت ناموفق و عدم اعمال</span>
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