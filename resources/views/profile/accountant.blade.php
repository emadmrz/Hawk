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
                            <th class="text-right">#</th>
                            <th class="text-right">مبلغ (تومان)</th>
                            <th class="text-right">آیتم مرتبط</th>
                            <th class="text-right">درگاه</th>
                            <th class="text-right">توضیحات</th>
                            <th class="text-right">کد پیگیری</th>
                            <th class="text-right">تاریخ</th>
                            <th class="text-right">وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $key=>$payment)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ number_format($payment->amount) }}</td>
                                <td>
                                    @if($payment->itemable_type == 'App\Storage')
                                        افزایش حجم {{ $payment->itemable->capacity }} MB
                                    @elseif($payment->itemable_type == 'App\Poll')
                                        افزونه نظر سنجی
                                    @elseif($payment->itemable_type == 'App\Questionnaire')
                                        افزونه پرسشنامه
                                    @elseif($payment->itemable_type == 'App\Shop')
                                        افزونه فروشگاه ساز
                                    @elseif($payment->itemable_type == 'App\Advertise')
                                        افزونه تبلیغات
                                    @endif
                                </td>
                                <td>{{ $payment->gateway }}</td>
                                <td>{{ $payment->description }}</td>
                                <td>{{ $payment->au }}</td>
                                <td>{{ $payment->shamsi_created_at }}</td>
                                <td>
                                    @if($payment->status)
                                        <span class="label label-success">پرداخت موفق</span>
                                    @else
                                        <span class="label label-danger">پرداخت ناموفق</span>
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