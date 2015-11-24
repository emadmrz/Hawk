@if(count($user->offers))
<section class="shop special-offer">

        <div class="">
            <div class="row">

                <div class="col-md-12">

                    <div class="shop-info-container">

                        <div class="shop-info changeable " >
                            @foreach($user->coupon_gallery()->valid()->get() as $key=>$coupon)
                            <div class="content @if($key==0) active @endif" data-related-slide="{{$key}}">
                                <h3 class="text-center">{{$coupon->title}}</h3>
                                <ul class="info-box">
                                    <li><i class="fa icon-shopping-basket fa-lg"></i>{{$coupon->title}}</li>
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
                                    @foreach($user->coupon_gallery()->valid()->get() as $key=>$coupon)
                                    <li data-target="#carousel-special_offer" data-slide-to="{{$key}}" class="@if($key==0) active @endif" ></li>

                                        @endforeach

                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @foreach($user->coupon_gallery()->valid()->get() as $key=>$coupon)
                                <div class="item @if($key==0) active @endif " data-key="{{$key}}" >
                                    <img class="img-responsive" src="{{asset('img/files/')}}/{{$coupon->image}}" alt="...">
                                    <div class="carousel-caption">
                                        <div class="well">
                                            <table class="table" style="color: #333">
                                                <thead>

                                                    <tr>
                                                        <th>ارزش کوپن</th>
                                                        <th>قیمت برای شما</th>
                                                        <th>تاریخ انقضاء</th>
                                                        <th>عملیات</th>
                                                    </tr>

                                                </thead>
                                                @foreach($coupon->coupons()->validnum()->get() as $msc)
                                                    <tr>
                                                        <td> {{$msc->real_amount}} <span>تومان</span></td>
                                                        <td> {{$msc->pay_amount}} <span>تومان</span></td>
                                                        <td> {{$msc->diff_expired_at}}<span>دیگر</span></td>
                                                        <td><a href="{{route('home.profile.offer.coupon.invoice',[$user->id,$coupon->offer->id,$msc->id])}}" class="btn btn-xs btn-success" >خرید کوپن</a></td>
                                                    </tr>
                                                @endforeach
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

@endif