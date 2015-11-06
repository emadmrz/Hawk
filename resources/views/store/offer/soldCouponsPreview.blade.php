@extends('profile.layout')

@section('side')
    @include('store.offer.partials.offerManagementMenu')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                کوپن های خریداری شده
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right">#</th>
                        <th class="text-right">نام خریدار</th>
                        <th class="text-right">عنوان</th>
                        <th class="text-right">مبلغ واقعی</th>
                        <th class="text-right">پرداخت شده</th>
                        <th class="text-right">کد رهگیری</th>
                        <th class="text-right">تاریخ خرید</th>
                        <th class="text-right">انقضا</th>
                        <th class="text-right">وضعیت</th>
                        <th class="text-right">تسویه</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon_user as $coupon)
                        <tr>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->user->first_name}} {{$coupon->user->last_name}}</td>
                            <td>{{$coupon->coupon->title}}</td>
                            <td>{{$coupon->real_amount}}</td>
                            <td>{{$coupon->pay_amount}}</td>
                            <td>{{$coupon->tracking_code}}</td>
                            <td>{{$coupon->shamsi_updated_at}}</td>
                            <td>{{$coupon->expired_at}}</td>
                            <td class="status">
                                @if($coupon->status==2)
                                    <span class="label label-success">تسویه شده</span>
                                @elseif($coupon->status==1)
                                    <span class="label label-danger">تسویه نشده</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->status==1)
                                {!! Form::open(['action'=>['CouponController@sold',$coupon->id],'data-remote-multiple']) !!}
                                <input type="text" name="legal_code" class="form-control">
                                <input type="hidden" value="{{$coupon->tracking_code}}" name="tracking_code" class="form-control">
                                <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-money fa-lg"></i></button>
                                {!! Form::close() !!}
                                @else
                                    {{$coupon->shamsi_updated_at}}
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
@section('script')
    @endsection