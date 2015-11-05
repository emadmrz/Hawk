<section class="shop special-offer">

    <div class="">
        <div class="row">

            <div class="col-md-12">

                <div class="shop-info-container">

                    <div class="shop-info changeable " >
                        @foreach($user->coupons as $key=>$coupon)
                            <div class="content @if($key==0) active @endif" data-related-slide="{{$key}}">
                                <h3 class="text-center">{{$coupon->title}}</h3>
                                <!--<div class="description">-->
                                <!--با توجه به توسعه روز افزون اینترنت، روشهای خرید به کلی دگرگون شده است و جامعه به سمت خریداینترنتی محصول سوق پیدا کرده که این موضوع دارای مزیتهایی بسیاری می باشد.-->
                                <!--</div>-->
                                <ul class="info-box">
                                    <li><i class="fa icon-shopping-basket fa-lg"></i>{{$coupon->coupon_gallery->title}}</li>
                                    <li>{{$coupon->description}}</li>
                                </ul>
                                <div class="text-center enter-shop">
                                    <button id="show_offer_coupons" class="btn btn-default">مشاهده کوپن ها</button>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="shop-banner">

                    <div id="carousel-special_offer" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($user->coupons as $key=>$coupon)
                                <li data-target="#carousel-special_offer" data-slide-to="{{$key}}" class="@if($key==0) active @endif" ></li>

                            @endforeach

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($user->coupons as $key=>$coupon)
                                <div class="item @if($key==0) active @endif " data-key="{{$key}}" >
                                    <img class="img-responsive" src="{{asset('img/files/')}}/{{$coupon->coupon_gallery->image}}" alt="...">
                                    <div class="carousel-caption">
                                        <div class="well">
                                            <table class="table" style="color: #333">
                                                <thead>
                                                <tr>
                                                    <th>ارزش کوپن</th>
                                                    <th>قیمت برای شما</th>
                                                    <th>تاریخ انقضاء</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tr>
                                                    <td> {{$coupon->real_amount}}<span>تومان</span></td>
                                                    <td> {{$coupon->pay_amount}}<span>تومان</span></td>
                                                    <td> {{$coupon->diff_expired_at}}<span>دیگر</span></td>
                                                    <td><a href="#" class="btn btn-xs btn-success" >خرید کوپن</a></td>
                                                </tr>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            @endforeach

                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-special_offer" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-special_offer" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>



        </div>
    </div>


</section>