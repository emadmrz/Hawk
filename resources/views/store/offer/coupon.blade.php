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
                        <span class="hidden-xs">تعویض روغن ماشین شما</span>
                        <span class="visible-xs">تعویض روغن ماشین شما</span>
                    </div>
                </div>
                <div class="panel-body">
                    <img src="http://i.imgur.com/e07tg8R.png" class="coupon-img img-rounded">
                    <div class="col-md-12 well well-sm">
                        <div id="business-info">
                            <ul>
                                <li><span><i class="fa fa-phone"></i>09367458211</span></li>
                                <li><span><i class="fa fa-map-marker"></i> تهران نارمک میدان 46 </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="items">
                            <li>خریدار : عماد میرزایی</li>
                            <li>ارائه دهنده : احمد دارا</li>
                            <li>تاریخ دریافت کوپن : 24/03/1394</li>
                            <li>کد پیگیری : <span class="en-number">48dfds98dsf</span> </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="offer en-number">
                            <h4 class="text-muted"><del>25,000 تومان</del></h4>
                            <h3>25,000 تومان</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="disclosure">Using Genuine Oil Filter and
                            multigrade oil up to vehicle specification. Lube as
                            necessary. Ester Oil or Synthetic available at additional
                            cost. Excludes hazardous waste fee, tax and shop supplies,
                            where applicable. Offer not valid with previous charges or
                            with any other offers or specials. Customer must offer at
                            time of write-up. No cash value.</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="coupon-code">
                        کد فروشنده : 9745
                    <span class="print pull-left">
                        <a href="#" class="btn btn-link"><i class="fa fa-lg fa-print"></i> Print Coupon</a>
                    </span>
                    </div>
                    <div class="exp">تاریخ انتقضاء : 28/03/1394</div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
