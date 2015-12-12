@extends('top.layout')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

    <div class="top-list-search">
        <div class="row">

            <form class="">

                <div class="col-sm-1 pull-right">
                    <select class="form-control input-sm">
                        <option>کاربران</option>
                        <option>کالاها</option>
                    </select>
                </div>

                <div class="col-sm-2 pull-right">
                    <select class="form-control input-sm">
                        <option>پر ستاره ترین ها</option>
                        <option>پر بازدید ترین ها</option>
                        <option>محبوب ترین ها</option>
                        <option>پر مشتری ترین ها</option>
                    </select>
                </div>

                <div class="col-sm-2 pull-right">
                    <select class="form-control input-sm">
                        <option>تمامی دسته بندی ها</option>
                        <option>فرهنگی و علمی</option>
                        <option>فنی و مهندسی </option>
                        <option>مدیریت و مشاوره</option>
                        <option>رفاهی</option>
                        <option>غذایی و خوراکی</option>
                    </select>
                </div>


                <button class="btn btn-violet btn-sm">جستجوی برترین ها</button>

                <button class="btn btn-success pull-left btn-sm">چگونه جزء برترین ها شوم ؟</button>

            </form>

        </div>
    </div>

    <div class="col-sm-12">
        <div class="part-title">
            <h3> <button class="btn btn-violet btn-sm pull-left">لیست کامل</button> فرهنگی و علمی </h3>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="part-title">
            <h3> <button class="btn btn-violet btn-sm pull-left">لیست کامل</button> فنی و مهندسی </h3>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-12">
        <div class="part-title">
            <h3> <button class="btn btn-violet btn-sm pull-left">لیست کامل</button>مدیریت و مشاوره</h3>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

    <div class="search-result">
        <div class="col-sm-3">
            <div class="search-card">
                <div class="avatar">
                    <img src="{{ asset('img/persons/1.jpg') }}">
                </div>
                <div class="name">
                    مائوریا آنتونیولی
                </div>
                <div class="rate">
                    <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                </div>
                <div class="about-me">
                    سلام ، من مائوریا هستم تخصص من در زمینه بازاریابی استارت آپ های اینترنتی است. راز موفقیت شما در دست من است.
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </button>
                </div>
            </div>
        </div>
    </div>

@endsection

