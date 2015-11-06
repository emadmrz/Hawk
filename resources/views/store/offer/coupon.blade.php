<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>کوپن</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">

</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default coupon">
                <div class="panel-heading" id="head">
                    <div class="panel-title" id="title">
                        <img src="{{ asset('/img/logo/skillema_dark.png') }}">
                        <span class="hidden-xs">{{$couponUser->coupon->title}}</span>
                        <span class="visible-xs">{{$couponUser->coupon->title}}</span>
                    </div>
                </div>
                <div class="panel-body">
                    <img class="coupon-img img-rounded" src="{{ asset('img/files/') }}/{{$couponUser->coupon->coupon_gallery->image}}">
                    <div class="col-md-12 well well-sm">
                        <div id="business-info">
                            <ul>
                                <li><span><i class="fa fa-phone"></i>09367458211</span></li>
                                <li><span><i class="fa fa-map-marker"></i> آدرس فروشنده</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="items">
                            <li><span>خریدار :</span> {{$couponUser->user->first_name}} {{$couponUser->user->last_name}}</li>
                            <li><span>ارائه دهنده :</span> {{$couponUser->coupon->user->first_name}} {{$couponUser->coupon->user->last_name}}</li>
                            <li><span>تاریخ خرید کوپن :</span> {{$couponUser->shamsi_updated_at}}</li>
                            <li> <span>کد پیگیری :</span> <span class="en-number">{{$couponUser->tracking_code}}</span> </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="offer en-number">
                            <h4 class="text-muted"><del>{{$couponUser->real_amount}} <span>تومان</span></del></h4>
                            <h3>{{$couponUser->pay_amount}} <span>تومان</span></h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="disclosure">
                            {{$couponUser->coupon->description}}
                        </p>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="coupon-code">
                        <span>کد فروشنده :</span> <span>{{$couponUser->legal_code}}</span>
                    <span class="print pull-left">
                        <a href="#" class="btn btn-link"><i class="fa fa-lg fa-print"></i> Print Coupon</a>
                    </span>
                    </div>
                    <div class="exp"><span>تاریخ انقضاء :</span> {{$couponUser->expired_at}}</div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
