@extends('store.layout')

@section('header')
    @include('partials.navbar')
    @include('profile.partials.cover')
@endsection

@section('content')
    <div class="col-sm-12 store">

        {{--<ul class="breadcrumb">--}}
            {{--<li><a href="#">خانه</a></li>--}}
            {{--<li><a href="#">پروفایل</a></li>--}}
            {{--<li><a href="#">شلوغش کن</a></li>--}}
            {{--<li class="active">افزونه  افزایش رتبه در نتایج جستجو</li>--}}
            {{--<button class="pull-left btn btn-success btn-xs">راهنمای خرید</button>--}}
        {{--</ul>--}}

        <div class="row">
            <div class="show-item">
                <div class="col-sm-4 pull-right">

                    <div class="image">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonAdvertise.images')[0]) }}">
                    </div>
                    <div class="other-image">
                        <ul class="row">
                            @foreach(Config::get('addonAdvertise.images') as $image)
                                <li class="col-sm-3" ><a href="#"><img src="{{ asset('img/icons/store/'.$image) }}" ></a></li>
                            @endforeach
                        </ul>
                    </div>

                    @include('partials.addonShop')

                </div>

                <div class="col-sm-8 pull-right">
                    {!! Form::open(['route'=>'store.advertise.buy', 'method'=>'get', 'id'=>'store_advertise_form']) !!}
                    <div class="title">
                        <h3>{{ Config::get('addonAdvertise.title') }}</h3>
                        <ul class="info">
                            <li><i class="fa fa-shopping-cart fa-lg" ></i><span> {{ $advertise->num_buy }} خرید از افزونه </span> </li>
                            <li><i class="fa fa-comments-o fa-lg" ></i><span> {{ $advertise->num_comment }} دیدگاه </span> </li>
                            <li class="rate" ><div class="item-rate ltr" data-id="1" data-rating="3.5" ></div></li>
                        </ul>
                    </div>
                    <div class="content">
                        <p>{{ Config::get('addonAdvertise.description') }}</p>

                        @foreach(Config::get('addonAdvertise.attributes') as $index=>$attribute)
                            <div class="lists row">
                                <div class="col-sm-2">{{ $attribute['title'] }} : </div>
                                <div class="center-block">
                                    @foreach($attribute['values'] as $key=>$value)
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio{{ $key }}" value="{{ $index }}::{{ $key }}" name="{{ $attribute['name'] }}" >
                                            <label for="inlineRadio{{ $key }}">{{ $value['name'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="lists row">
                            <div class="col-sm-2">مدت رزرو :</div>
                            <div class="col-sm-2 row">
                                {!! Form::input('number', 'reserve', 1, ['class'=>'form-control en-number']) !!}
                            </div>
                        </div>

                        <div class="lists text-danger" id="advertise_availability" style="display: none">

                        </div>

                        <div class="lists row">
                            <div class="col-sm-2"> قیمت اولیه :</div>
                            <div class="center-block">
                                <del class="discount" id="base_amount">{{ number_format(Config::get('addonAdvertise.base_price')) }} تومان  </del>
                            </div>
                        </div>

                        <div class="lists row">
                            <div class="col-sm-2">قیمت برای شما : </div>
                            <div class="center-block">
                                <div class="price" id="final_amount">{{ number_format(Config::get('addonAdvertise.base_price') - Config::get('addonAdvertise.base_price')*Config::get('addonAdvertise.discount')  ) }} تومان </div>
                                @if(Config::get('addonAdvertise.discount'))
                                    <div class="coupon"><span id="discount_amount">{{ number_format(Config::get('addonAdvertise.base_price')*Config::get('addonAdvertise.discount')) }}</span> تومان تخفیف | برای دریافت تخفیف ایمیل خود را تایید نمایید</div>
                                @endif
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
                                <button id="buy_advertise" class="btn btn-violet btn-block">خرید افزونه</button>
                            </div>
                        </div>
                    </div>



                    {!! Form::close() !!}
                </div>

                <div class="col-sm-8">
                    <div class="comment-list">
                        @if(Auth::check())
                            <div class="new-comment">

                                {!! Form::open(['route'=>['store.advertise.comment'], 'method'=>'post']) !!}
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

                            @foreach($advertise->comments as $comment)
                                <div class="media">
                                    <div class="media-right">
                                        <a href="{{ route('home.profile', $comment->user_id) }}">
                                            <img class="media-object" src="{{asset('img/persons/'.$comment->user->avatar)}}" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{ route('home.profile', $comment->user_id) }}">{{ $comment->user->username }}</a><span class="info">{{ $comment->shamsi_human_created_at }}</span></h5>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>
                </div>

                <div class="clearfix"></div>

            </div>

        </div>

    </div>
@endsection