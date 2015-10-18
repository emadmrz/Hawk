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
            <li class="active">شلوغش کن</li>
            <button class="pull-left btn btn-success btn-xs">راهنمای خرید</button>
        </ul>

        <div class="row">


            <div class="col-sm-3">
                <div class="col-item">
                    <div class="photo">
                        <img src="{{ asset('img/icons/store/infographic-free-download_23-2147489175.jpg') }}" class="img-responsive" alt="a" />
                        <div class="name">افزونه فروشگاه ساز</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>
                                    فروشگاه ساز </h5>
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
                        <img src="{{ asset('img/icons/store/special-offer-tag_23-2147500541.jpg') }}" class="img-responsive" alt="a" />
                        <div class="name">افزونه پیشنهاد ویژه برای فروش</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>پیشنهاد ویژه</h5>
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
                        <img src="{{ asset('img/icons/store/marketing-communication-vector_23-2147501099.jpg') }}" class="img-responsive" alt="a" />
                        <div class="name">تبلیغات در صفحه اول</div>
                        <!--<div class="discount">50% تخفیف  <br><del>40,000 تومان</del></div>-->
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price col-md-6">
                                <h5>تبلیغات   </h5>
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

        </div>

        <div class="well help">
            <h3>پس از خرید افزونه ها</h3>
            <p>
                پس از خرید هر یک افزونه ها، مورد خریداری شده به صورت خودکار در حساب کاربری شما فعال شده و از منوی افزونه ها در بالای صفحه قابل دسترسی می باشد.
            </p>
        </div>

    </div>


@endsection