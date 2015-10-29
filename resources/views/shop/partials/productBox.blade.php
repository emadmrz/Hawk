<div class="product-box">

    <div class="col-sm-12">
        <h3 class="headline">جدیدترین محصولات</h3>
        <span class="line margin-bottom-0"></span>
    </div>

    <div id="LatestProductSlide" class="carousel slide" data-ride="carousel" data-interval="10000">


        <div class="carousel-inner" role="listbox">
            <?php $key=-1; ?>
            @foreach($latest_products as $key=>$product)
                @if($key == 0)
                    <div class="item active">
                @elseif($key % 4 == 0)
                    <div class="item">
                @endif
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="{{ asset('img/files/shop/'.$product->files()->first()->name) }}" class="img-responsive" alt="{{ $product->name }}" />
                                    @if(!empty($product->discount) and $product->discount != 0)
                                        <div class="name">{{ $product->discount }}% تخفیف | <del> {{ number_format($product->price) }} تومان </del></div>
                                    @endif
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{ $product->name }}</h5>
                                            <h5 class="price-text-color">{{ number_format(($product->price-($product->price*$product->discount/100))) }} تومان </h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-12">
                                            <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('home.shop.product', [$shop->id, $product->id]) }}" class="btn btn-{{ $shop->theme }} btn-sm"><i class="fa icon-shopping-basket " ></i> مشاهده جزییات </a>

                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                @if($key % 3 == 0 and $key > 2)
                    </div>
                @endif
            @endforeach
                @if($key % 3 != 0 or $key == 0)
                    </div>
                @endif

        </div>


        <a class="left slide-control" href="#LatestProductSlide" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right slide-control" href="#LatestProductSlide" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <a class="total-list slide-control" href="#">لیست تمامی محصولات</a>

    </div>



</div>