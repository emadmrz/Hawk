@extends('shop.layout')

@section('content')

    <div class="show-product">

        <div class="col-sm-4 pull-right" id="product_images_list">

            <div class="image">
                <img src="{{ asset('img/files/shop/'.$product->files()->first()->name) }}">
            </div>
            <div class="other-image">
                <ul class="row">
                    @foreach($product->files()->get() as $file)
                        <li class="col-sm-3" ><a href="#"><img src="{{ asset('img/files/shop/'.$file->name) }}" ></a></li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="col-sm-8 pull-right">
            <div class="title">
                <h3>{{ $product->name }}</h3>
                <ul class="info">
                    <li><i class="fa fa-shopping-cart fa-lg" ></i><span> 0 خرید از محصول </span> </li>
                    <li><i class="fa fa-comments-o fa-lg" ></i><span> {{ $product->num_comment }} دیدگاه </span> </li>
                    <li><i class="fa fa-eye fa-lg" ></i><span> {{ $product->num_visit }} بازید از کالا </span> </li>
                    <li class="rate" ><div class="item-rate ltr" data-id="1" data-rating="3.5" ></div></li>
                </ul>
            </div>

            <div class="content">
                {!! Form::open(['id'=>'product_form']) !!}
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <p>{{ $product->description }}</p>

                @foreach($types as $type)
                <div class="lists row">
                    <div class="col-sm-3">{{ $type->attribute_group->name }} : </div>
                    <div class="center-block">
                        @foreach($attributes->where('attribute_group_id', $type->attribute_group->id) as $attribute)
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="attribute{{ $attribute->id }}" value="{{ $attribute->id }}" name="attribute[{{ $type->attribute_group->type }}]" checked="">
                                @if( $type->attribute_group->type == 'color' )
                                    <label for="attribute{{ $attribute->id }}"><span class="color-attribute" style="background-color: {{ $attribute->value }}" ></span></label>
                                @else
                                    <label for="attribute{{ $attribute->id }}">{{ $attribute->value }}</label>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="lists row">
                    <div class="col-sm-3">تعداد خرید</div>
                    <div class="col-sm-2 row">
                        <input type="number" class="form-control" value="1" id="quantity" name="quantity">
                    </div>
                </div>

                @if($product->discount)
                    <div class="lists row">
                        <div class="col-sm-3"> قیمت اولیه :</div>
                        <div class="center-block">
                            <del class="discount" id="amount">{{ number_format($product->price) }} تومان </del>
                        </div>
                    </div>
                @endif
                <div class="lists row">
                    <div class="col-sm-3">قیمت برای شما : </div>
                    <div class="center-block">
                        <div class="price" id="final_amount">{{ number_format(($product->price - ($product->price*$product->discount/100))) }} تومان </div>
                        @if(Auth::check())
                            @if(!Auth::user()->confirmed)
                                <div class="coupon"><span id="discount_amount">{{ number_format($product->price*$product->discount/100) }}</span> تومان تخفیف | برای دریافت تخفیف ایمیل خود را تایید نمایید</div>
                            @endif
                        @else
                            <div class="coupon"><span id="discount_amount">{{ number_format($product->price*$product->discount/100) }}</span> تومان تخفیف | برای دریافت تخفیف ایمیل خود را تایید نمایید</div>
                        @endif
                    </div>
                </div>

                <div class="buy-now col-sm-3 pull-right">
                    <div class="row">
                        <button class="btn btn-{{ $shop->theme }} btn-block">خرید کالا </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>

        <div class="clearfix"></div>

        <div class="col-sm-8">
            <div class="comment-list">
                @if(Auth::check())
                    <div class="new-comment">

                        {!! Form::open(['route'=>['home.shop.product.comment', $shop->id, $product->id ], 'method'=>'post']) !!}
                        <div class="media">
                            <div class="media-right">
                                <a href="#">
                                    <img class="media-object" src="{{asset('img/persons/'.$user->avatar)}}" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <textarea name="body" placeholder="شما هم می توانید دیدگاه خود را درباره این کالا بیان نمایید."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-paper-plane-o"></i> ثبت دیدگاه </button>
                        {!! Form::close() !!}<hr>

                    </div>
                @endif
                <div class="comments">

                    @foreach($product->comments as $comment)
                        <div class="media">
                            <div class="media-right">
                                <a href="#">
                                    <img class="media-object" src="{{asset('img/persons/'.$comment->user->avatar)}}" alt="...">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading"><a href="#">{{ $comment->user->username }}</a><span class="info">{{ $comment->shamsi_human_created_at }}</span></h5>
                                <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>

        <div class="clearfix"></div>

    </div>

@endsection