@extends('shop.layout')

@section('content')
<div class="product-list-filter">
    {!! Form::model($input, ['method'=>'get']) !!}
        <div class="filter-box">
            <div class="col-sm-4 pull-right">
                {!! Form::text('keyword', null, ['class'=>'form-control input-sm', 'placeholder'=>"جستجو ..."]) !!}
            </div>
            <div class="col-sm-3 pull-right">
                {!! Form::select('category_id', $categories, null, ['class'=>'form-control input-sm']) !!}
            </div>
            <div class="col-sm-2 pull-right">
                <select class="form-control input-sm" name="order">
                    <option value="1" >جدیدترین ها</option>
                    <option value="2" >محبوب ترین ها</option>
                    <option value="3">پر بازدید ترین ها</option>
                    <option value="4">ارزان ترین ها</option>
                </select>
            </div>
            <button class="btn btn-{{ $shop->theme }} btn-sm">جستجو</button>
        </div>
    {!! Form::close() !!}
</div>

<div class="product-list-show">

    @foreach($products as $key=>$product)

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

    @endforeach

    <div class="clearfix"></div>

</div>
@endsection