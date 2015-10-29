<div class="shop-statistics clearfix">

    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="headline">پر بحث ترین ها</h3>
            <span class="line"></span>
        </div>
        <ul>

            @foreach($top_comment_products as $product)
                <li>
                    <a href="{{ route('home.shop.product', [$shop->id, $product->id]) }}">
                        <div class="image">
                            <img class="img-rounded" src="{{ asset('img/files/shop/'.$product->files()->first()->name) }}" alt="">
                            @if($product->discount)
                                <div class="discount">{{ $product->discount }}%</div>
                            @endif
                        </div>
                        <div class="info">
                            <div class="name">{{ $product->name }}</div>
                            <div class="price">{{ number_format(($product->price-($product->price*$product->discount/100))) }} تومان </div>
                            <div class="rate"><div class="product-rate ltr" data-id="1" data-rating="2.2"></div></div>
                        </div>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="headline">محبوب ترین ها</h3>
            <span class="line"></span>
        </div>
        <ul>

            @foreach($shop->products()->get()->take(3) as $product)
                <li>
                    <a href="{{ route('home.shop.product', [$shop->id, $product->id]) }}">
                        <div class="image">
                            <img class="img-rounded" src="{{ asset('img/files/shop/'.$product->files()->first()->name) }}" alt="">
                            @if($product->discount)
                                <div class="discount">{{ $product->discount }}%</div>
                            @endif
                        </div>
                        <div class="info">
                            <div class="name">{{ $product->name }}</div>
                            <div class="price">{{ number_format(($product->price-($product->price*$product->discount/100))) }} تومان </div>
                            <div class="rate"><div class="product-rate ltr" data-id="1" data-rating="2.2"></div></div>
                        </div>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="col-sm-4">
        <div class="col-sm-12">
            <h3 class="headline">پر بازدید ترین ها</h3>
            <span class="line"></span>
        </div>
        <ul>

            @foreach($top_visit_products as $product)
            <li>
                <a href="{{ route('home.shop.product', [$shop->id, $product->id]) }}">
                    <div class="image">
                        <img class="img-rounded" src="{{ asset('img/files/shop/'.$product->files()->first()->name) }}" alt="">
                        @if($product->discount)
                            <div class="discount">{{ $product->discount }}%</div>
                        @endif
                    </div>
                    <div class="info">
                        <div class="name">{{ $product->name }}</div>
                        <div class="price">{{ number_format(($product->price-($product->price*$product->discount/100))) }} تومان </div>
                        <div class="rate"><div class="product-rate ltr" data-id="1" data-rating="2.2"></div></div>
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>

</div>