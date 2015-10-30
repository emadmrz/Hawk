@extends('store.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('content')
    <div class="col-sm-12 store">

        <ul class="breadcrumb">
            <li><a href="#">خانه</a></li>
            <li><a href="#">پروفایل</a></li>
            <li><a href="#">شلوغش کن</a></li>
            <li class="active">افزونه پیشنهاد ویژه</li>
            <button class="pull-left btn btn-success btn-xs">راهنمای خرید</button>
        </ul>
        <div class="row">
            <div class="show-item">
                <div class="col-sm-4 pull-right">
                    <div class="image">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonOffer.images')[0]) }}">
                    </div>
                    <div class="other-image">
                        <ul class="row">
                            @foreach(Config::get('addonOffer.images') as $image)
                                <li class="col-sm-3" ><a href="#"><img src="{{ asset('img/icons/store/'.$image) }}" ></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 pull-right">
                    {!! Form::open(['route'=>'store.offer.buy', 'method'=>'get']) !!}
                    <div class="title">
                        <h3>افزونه پیشنهاد ویژه</h3>
                        <ul class="info">
                            <li><i class="fa fa-shopping-cart fa-lg" ></i><span> 5 خرید از افزونه </span> </li>
                            <li><i class="fa fa-comments-o fa-lg" ></i><span> 32 دیدگاه </span> </li>
                            <li class="rate" ><div class="item-rate ltr" data-id="1" data-rating="3.5" ></div></li>
                        </ul>
                    </div>
                    <div class="content">
                        <p>{{ Config::get('addonOffer.description') }}</p>
                        <div class="lists row">
                            <div class="col-sm-2"> قیمت اولیه :</div>
                            <div class="center-block">
                                <del class="discount">{{ number_format(Config::get('addonOffer.base_price')) }} تومان  </del>
                            </div>
                        </div>
                        <div class="lists row">
                            <div class="col-sm-2">قیمت برای شما : </div>
                            <div class="center-block">
                                <div class="price">{{ number_format(Config::get('addonOffer.base_price') - Config::get('addonOffer.base_price')*Config::get('addonOffer.discount')  ) }} تومان </div>
                                <div class="coupon">10,000 تومان تخفیف | برای دریافت تخفیف ایمیل خود را تایید نمایید</div>
                            </div>
                        </div>

                        <div class="lists row">
                            <div class="col-sm-2">درگاه پرداخت : </div>
                            <div class="center-block">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="paymentRadio1" value="mellat" name="payment_gate" >
                                    <label for="paymentRadio1"><img width="30px" src="{{ asset('img/icons/mellat.png') }}" title="درگاه پرداخت بانک ملت" >&ensp;   بانک ملت   </label>
                                </div>
                            </div>
                        </div>

                        <div class="buy-now col-sm-3 pull-right">
                            <div class="row">
                                <button class="btn btn-violet btn-block">خرید افزونه</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

    </div>
@endsection