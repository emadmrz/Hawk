@extends('search.layout')

@section('header')
    @include('partials.navbar')
@endsection

@section('content')

    <div class="col-sm-12">

        <div class="panel panel-default search-panel">
            <div class="panel-heading">
                <h3 class="panel-title">جستجوی در بین کاربران ، مهارت ها و کالاها</h3>
            </div>
            <div class="panel-body search-box">
                <form class="form-horizontal">

                    <h5>
                        <div class="row toggle-demo ltr">

                            <div class="switch-toggle switch-2 well col-lg-3">
                                <i class="fa icon-shopping-basket fa-3x left-icon iconi"></i>
                                <input id="week-d1" name="view-d" type="radio" value="product" checked>
                                <label for="week-d1" onclick="">جستجو در بین کالا</label>

                                <input id="month-d2" name="view-d" value="person" type="radio">
                                <label for="month-d2" onclick="">جستجو در بین کاربران</label>
                                <i class="fa icon-user-2 fa-3x right-icon iconi"></i>
                                <a class="btn btn-success"></a>
                            </div>
                        </div>
                    </h5>

                    <div id="product_search">

                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup4" aria-expanded="true" aria-controls="collapseListGroup4">مشخصات فروشگاه</a></h3>

                        <div class="collapse in collapse-content" id="collapseListGroup4"  aria-expanded="true">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >نام فروشگاه</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >استان</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تهران</option>
                                                    <option value="3">شیراز</option>
                                                    <option value="3">اصفهان</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >شهر</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تهران</option>
                                                    <option value="3">شیراز</option>
                                                    <option value="3">اصفهان</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox6" value="option1">
                                                <label for="inlineCheckbox6">تحویل سراسر کشور</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox7" value="option1">
                                                <label for="inlineCheckbox7">ضمانت تعویض</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox8" value="option1">
                                                <label for="inlineCheckbox8">ضمانت تعمیر</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox10" value="option1">
                                                <label for="inlineCheckbox10">پرداخت آنلاین</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3">پرداخت در محل</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup5" aria-expanded="true" aria-controls="collapseListGroup5">مشخصات کالا</a></h3>

                        <div class="collapse in collapse-content" id="collapseListGroup5"  aria-expanded="true">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >عنوان کالا</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی کالا</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تهران</option>
                                                    <option value="3">شیراز</option>
                                                    <option value="3">اصفهان</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >قیمت از</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control">
                                            </div>
                                            <label class="col- control-label" >تا</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3">فقط کالاهای موجود</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3"> دارای عکس</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3">دارای تخفیف</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3">فقط فروش قسطی</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <h3><button class="btn btn-default btn-sm">جستجو در سایت</button></h3>

                        <div class="collapse-content">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col- control-label" >مرتب سازی بر اساس</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">پر بازدیدترین ها</option>
                                                    <option value="2">محبوب ترین ها</option>
                                                    <option value="3">پر فروش ترین</option>
                                                    <option value="3">قیمت</option>
                                                    <option value="3">نزدیک ترین به من</option>
                                                    <option value="3">جدیدترین ها</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="em-hide" id="person_search">

                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup6" aria-expanded="true" aria-controls="collapseListGroup6">مشخصات کاربر</a></h3>
                        <div class="collapse in collapse-content" id="collapseListGroup6"  aria-expanded="true">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col- control-label" >نام کاربر</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >نوع کاربر</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">حقیقی </option>
                                                    <option value="3">حقوقی</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >جنسیت</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">حقیقی </option>
                                                    <option value="3">حقوقی</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >وضعیت تاهل</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">حقیقی </option>
                                                    <option value="3">حقوقی</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >استان</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تهران</option>
                                                    <option value="3">شیراز</option>
                                                    <option value="3">اصفهان</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >شهر</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تهران</option>
                                                    <option value="3">شیراز</option>
                                                    <option value="3">اصفهان</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup7" aria-expanded="true" aria-controls="collapseListGroup7">مشخصات مهارت</a></h3>

                        <div class="collapse in collapse-content" id="collapseListGroup7"  aria-expanded="true">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی سطح اول</label>
                                            <div class="col-sm-7">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی سطح دوم</label>
                                            <div class="col-sm-7">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی سطح سوم</label>
                                            <div class="col-sm-7">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >عنوان مهارت</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >سطح مهارت</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                    <option value="3">طبقه بندی سطح اول مهارت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >سطح خود ارزیابی</label>
                                            <div class="col-sm-7">
                                                <select class="form-control">
                                                    <option value="1">اهمیتی ندارد</option>
                                                    <option value="2">تازه کار</option>
                                                    <option value="3">قابل قبول</option>
                                                    <option value="3">حرفه ای</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >محل ارائه مهارت</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >سابقه بیش از</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox6" value="option1">
                                                <label for="inlineCheckbox6">داشتن نمونه کار</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox7" value="option1">
                                                <label for="inlineCheckbox7">داشتن مدرک گواهینامه</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox8" value="option1">
                                                <label for="inlineCheckbox8">داشتن سابقه</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox10" value="option1">
                                                <label for="inlineCheckbox10"> داشتن ارزیابی</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" value="option1">
                                                <label for="inlineCheckbox3">فقط مهارت های قابل ارائه</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup8" aria-expanded="true" aria-controls="collapseListGroup8">مشخصات کالا</a></h3>

                        <div class="collapse in collapse-content" id="collapseListGroup8"  aria-expanded="true">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >روز ارائه مهارت از</label>
                                            <div class="col-sm-4">
                                                <select class="form-control">
                                                    <option value="1">شنبه</option>
                                                    <option value="2">یکشنبه</option>
                                                    <option value="3">دوشنبه</option>
                                                    <option value="4">سه شنبه</option>
                                                    <option value="5">چهارشنبه</option>
                                                    <option value="6">پنجشنبه</option>
                                                    <option value="7">جمعه</option>
                                                </select>
                                            </div>
                                            <label class="col- control-label" >تا</label>
                                            <div class="col-sm-4">
                                                <select class="form-control">
                                                    <option value="1">شنبه</option>
                                                    <option value="2">یکشنبه</option>
                                                    <option value="3">دوشنبه</option>
                                                    <option value="4">سه شنبه</option>
                                                    <option value="5">چهارشنبه</option>
                                                    <option value="6">پنجشنبه</option>
                                                    <option value="7">جمعه</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >ساعت ارائه از</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control">
                                            </div>
                                            <label class="col- control-label" >تا</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <h3><button class="btn btn-default btn-sm">جستجو در سایت</button></h3>

                        <div class="collapse-content">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col- control-label" >مرتب سازی بر اساس</label>
                                            <div class="col-sm-8">
                                                <select class="form-control">
                                                    <option value="1">سطح مهارت – خود اظهاری</option>
                                                    <option value="2"> نزدیک ترین به من</option>
                                                    <option value="3">سطح مهارت – ارزیابی سایت</option>
                                                    <option value="3">امتیاز گواهینامه</option>
                                                    <option value="3">  میزان سابقه</option>
                                                    <option value="3">میزان تحصیلات</option>
                                                    <option value="3">درصد تکمیل بودن پروفایل</option>
                                                    <option value="3">  تعداد کارهای واگذار شده از طریق سایت</option>
                                                    <option value="3">پیشنهاد ویژه</option>
                                                    <option value="3">سطح مهارت</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                </form>


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
                    ظروف نقش دار اصیل ایرانی
                </div>
                <div class="rate">
                    <div class="item"><i class="fa fa-shopping-cart fa-lg" ></i> 25 خرید </div>
                    <div class="item"><i class="fa fa-commenting-o fa-lg" ></i> 12 دیدگاه </div>
                </div>
                <div class="about-me">
                    صنایع دستی اصیل ایرانی سوغات اصفهان با طرحی بسیار زیبا و دلنشین می تواند بهترین هدیه برای عزیزانتان باشد
                </div>
                <div class="action text-center">
                    <button type="button" class="btn btn-success btn-sm "><i class="fa icon-shopping-basket fa-lg" ></i>مشخصات کالا</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        //        $("#advance_search_elements").hide();
        $(document).ready(function(){


            $("#toggle_advance").click(function(e){
                e.preventDefault()
                $("#advance_search_elements").slideToggle()
            });

            $('input[type=radio][name=view-d]').change(function() {
                if (this.value == 'product') {
                    $("#person_search").fadeOut('fast', function(){
                        $("#product_search").fadeIn('fast');
                    });
                    console.log('product');
                }
                else if (this.value == 'person') {
                    $("#product_search").fadeOut('fast' , function(){
                        $("#person_search").fadeIn('fast');
                    });
                    console.log('person');
                }
            });


        });
    </script>

    <script>
        function rateAlert(id, rating)
        {
            alert( 'Rating for '+id+' is '+rating+' stars!' );
        }

        /* Here we initialize raterater on our rating boxes
         */
        $(function() {
            $( '.user-rate' ).raterater( {
                submitFunction: 'rateAlert',
                allowChange: true,
                starWidth: 18,
                spaceWidth: 1,
                numStars: 5
            } );
        });
    </script>

@endsection