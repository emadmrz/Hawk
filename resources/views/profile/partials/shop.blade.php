@if(count($user->shop))
<section class="shop">

    <div class="">
        <div class="row">

            <div class="col-md-12">

                <div class="shop-info-container">
                    <div class="shop-info">
                        <h3 class="text-center">{{ $shop->title }}</h3>
                        <!--<div class="description">-->
                        <!--با توجه به توسعه روز افزون اینترنت، روشهای خرید به کلی دگرگون شده است و جامعه به سمت خریداینترنتی محصول سوق پیدا کرده که این موضوع دارای مزیتهایی بسیاری می باشد.-->
                        <!--</div>-->
                        <ul class="info-box">

                            <li><i class="fa icon-shopping-basket fa-lg"></i>  صنایع دستی ، سوغاتی ، کالاهای فرهنگی</li>
                            <li><i class="fa icon-file-box fa-lg"></i> تعداد محصولات :  {{ $shop->products->count() }}</li>
                            <li><i class="fa icon-visual-eye fa-lg"></i>تعداد بازدید از فروشگاه : {{ $shop->num_visit }}</li>
                            <li><i class="fa icon-shopping-cart fa-lg"></i>تعداد فروش : {{ $shop->num_buy }}</li>
                        </ul>
                        <div class="text-center enter-shop">
                            <a href="{{ route('home.shop.index', $shop->id) }}" ><button class="btn btn-default">ورود به فروشگاه</button></a>
                        </div>

                    </div>
                </div>

                <div class="shop-banner">

                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($user->shop->files as $key=>$file)
                                <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" @if($key==0) class="active" @endif></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($user->shop->files as $key=>$file)
                                <div class="item @if($key==0) active @endif">
                                    <img src="{{ asset('img/files/shop/'.$file->name) }}" alt="...">
                                    <div class="carousel-caption">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>



        </div>
    </div>

    <div class="">
        <div class="row">
            <div class="shop-properties">

                @foreach($advantages as $advantage)
                    <div class="col-md-2">
                        <div class="property-item @if(!in_array($advantage->id, $advantage_shop)) disable @endif "><i class="fa {{ $advantage->logo }} fa-3x"></i>
                            {{ $advantage->title }}
                        </div>
                    </div>
                @endforeach

            </div>


        </div>
    </div>

</section>
@endif