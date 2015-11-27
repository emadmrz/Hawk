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
            {{--<li class="active">شلوغش کن</li>--}}
            {{--<button class="pull-left btn btn-success btn-xs">راهنمای خرید</button>--}}
        {{--</ul>--}}

        <div class="row">


            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonShop.banner')) }}" class="img-responsive" alt="{{ Config::get('addonShop.title') }}" />
                        <div class="name">{{ Config::get('addonShop.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonShop.title') }}</h5>
                                <h5 class="price-text-color">{{ number_format(Config::get('addonShop.base_price')) }} تومان  </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{ route('store.shop') }}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{ route('store.shop') }}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonPoll.banner')) }}" class="img-responsive" alt="{{ Config::get('addonPoll.title') }}" />
                        <div class="name">{{ Config::get('addonPoll.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonPoll.title') }}</h5>
                                <h5 class="price-text-color">{{ number_format(Config::get('addonPoll.base_price')) }} تومان  </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{ route('store.poll') }}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{ route('store.poll') }}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonQuestionnaire.banner')) }}" class="img-responsive" alt="{{ Config::get('addonQuestionnaire.title') }}" />
                        <div class="name">{{ Config::get('addonQuestionnaire.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonQuestionnaire.title') }}</h5>
                                <h5 class="price-text-color">{{ number_format(Config::get('addonQuestionnaire.base_price')) }} تومان  </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{ route('store.questionnaire') }}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{ route('store.questionnaire') }}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonOffer.banner')) }}" class="img-responsive" alt="a" />
                        <div class="name">افزونه پیشنهاد ویژه برای فروش</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{Config::get('addonOffer.title')}}</h5>
                                <h5 class="price-text-color">
                                    {{number_format(Config::get('addonOffer.base_price'))}} تومان
                                </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{route('store.offer')}}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{route('store.offer')}}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonStorage.banner')) }}" class="img-responsive" alt="{{ Config::get('addonStorage.title') }}" />
                        <div class="name">{{ Config::get('addonStorage.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonStorage.title') }}</h5>
                                <h5 class="price-text-color">{{ number_format(Config::get('addonStorage.base_price')) }} تومان  </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{ route('store.storage') }}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{ route('store.storage') }}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/'.Config::get('addonAdvertise.banner')) }}" class="img-responsive" alt="{{ Config::get('addonAdvertise.title') }}" />
                        <div class="name">{{ Config::get('addonAdvertise.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonAdvertise.title') }}</h5>
                                <h5 class="price-text-color">{{ number_format(Config::get('addonAdvertise.base_price')) }} تومان  </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{ route('store.advertise') }}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{ route('store.advertise') }}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/search-engine-optimization-concept-vector_23-2147497530.jpg') }}" class="img-responsive" alt="a" />
                        <div class="name"> افزایش رتبه در نتایج جستجو</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>افزایش رتبه</h5>
                                <h5 class="price-text-color">
                                    30,000 تومان</h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/search-engine-optimization-concept-vector_23-2147497530.jpg') }}" class="img-responsive" alt="a" />
                        <div class="name">{{ Config::get('addonRelater.slug') }}</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>{{ Config::get('addonRelater.title') }}</h5>
                                <h5 class="price-text-color">
                                    {{ number_format(Config::get('addonRelater.base_price')) }} تومان
                                </h5>
                            </div>
                            <div class="rating hidden-sm col-md-6">
                                <div class="service-rate ltr" data-id="1" data-rating="2.2"></div>
                            </div>
                        </div>
                        <div class="separator clear-left">
                            <p class="btn-add">
                                <i class="fa fa-shopping-cart"></i><a href="{{route('store.relater')}}" class="hidden-sm">خرید افزونه</a></p>
                            <p class="btn-details">
                                <i class="fa fa-list"></i><a href="{{route('store.relater')}}" class="hidden-sm"> جزئیات بیشتر </a></p>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="well help">
            <h3>پس از خرید افزونه ها</h3>
            <p>
                پس از خرید هر یک افزونه ها، مورد خریداری شده به صورت خودکار در حساب کاربری شما فعال شده و از منوی افزونه ها در بالای صفحه قابل دسترسی می باشد.
            </p>
        </div>

    </div>


@endsection