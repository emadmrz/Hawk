@extends('profile.layout')
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
                        <th class="text-right">نام فروشنده</th>
                        <th class="text-right">عنوان</th>
                        <th class="text-right">مبلغ واقعی</th>
                        <th class="text-right">پرداخت شده</th>
                        <th class="text-right">تاریخ خرید</th>
                        <th class="text-right">انقضا</th>
                        <th class="text-right">وضعیت</th>
                        <th class="text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $key=>$coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$coupon->coupon->user->first_name}} {{$coupon->coupon->user->last_name}}</td>
                            <td>{{$coupon->coupon->title}}</td>
                            <td>{{$coupon->real_amount}}</td>
                            <td>{{$coupon->pay_amount}}</td>
                            <td>{{$coupon->shamsi_updated_at}}</td>
                            <td>{{$coupon->expired_at}}</td>
                            <td>
                                @if($coupon->status==2)
                                    <span class="label label-success">تسویه شده</span>
                                @elseif($coupon->status==1)
                                    <span class="label label-danger">تسویه نشده</span>
                                @endif
                            </td>
                            <td><a target="_blank" href="{{route('profile.coupon.preview',[$coupon->id])}}">نمایش</a></td>
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
@section('side')
    @include('partials.addonShop')
    @include('partials.addSkill')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection
@section('script')
@endsection