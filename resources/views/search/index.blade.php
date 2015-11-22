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
                {!! Form::model($user,['route'=>'search.fullSearch','class'=>'form-horizontal']) !!}

                    <h5>
                        <div class="row toggle-demo ltr">

                            <div class="switch-toggle switch-2 well col-lg-3">
                                <i class="fa icon-shopping-basket fa-3x left-icon iconi"></i>
                                <input id="week-d1" name="view_d" type="radio" value="products" @if($catSelected=='products') checked @endif>
                                <label for="week-d1" onclick="">جستجو در بین کالا</label>

                                <input id="month-d2" name="view_d" value="users" type="radio" @if($catSelected=='users') checked @endif>
                                <label for="month-d2" onclick="">جستجو در بین کاربران</label>
                                <i class="fa icon-user-2 fa-3x right-icon iconi"></i>
                                <a class="btn btn-success"></a>
                            </div>
                        </div>
                    </h5>

                    <div class="@if($catSelected=='users') em-hide @endif" id="product_search">

                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup4" aria-expanded="true" aria-controls="collapseListGroup4">مشخصات فروشگاه</a></h3>

                        <div class="collapse in collapse-content" id="collapseListGroup4"  aria-expanded="true">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col- control-label" >نام فروشگاه</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('shopTitle',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >استان</label>
                                            <div class="col-sm-9">
                                                {!! Form::select('productProvince',$provinces,null,['id'=>'province_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >شهر</label>
                                            <div class="col-sm-9">
                                                {!! Form::select('productCity',$cities,null,['id'=>'city_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('productReturn',4,null,['class'=>'form-control']) !!}
                                                <label for="productReturn">ضمانت بازگشت</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('payInHome',6,null,['class'=>'form-control']) !!}
                                                <label for="payInHome">پرداخت در محل</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('productGuarantee',3,null,['class'=>'form-control']) !!}
                                                <label for="productGuarantee">گارانتی سلامت کالا</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('productOriginal',2,null,['class'=>'form-control']) !!}
                                                <label for="productOriginal">تضمین اصالت</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('fastDeliver',1,null,['class'=>'form-control']) !!}
                                                <label for="fastDeliver">ارسال سریع کالا</label>
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
                                                {!! Form::text('productTitle',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی کالا</label>
                                            <div class="col-sm-8">
                                                {!! Form::select('productCat',$productCat,null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >قیمت از</label>
                                            <div class="col-sm-4">
                                                {!! Form::text('firstPrice',null,['class'=>'form-control']) !!}
                                            </div>
                                            <label class="col- control-label" >تا</label>
                                            <div class="col-sm-4">
                                                {!! Form::text('secondPrice',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('available',1,null,['class'=>'form-control']) !!}
                                                <label for="available">فقط کالاهای موجود</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('image',1,null,['class'=>'form-control']) !!}
                                                <label for="image"> دارای عکس</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('discount',1,null,['class'=>'form-control']) !!}
                                                <label for="discount">دارای تخفیف</label>
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
                                                {!! Form::select('productSort',[1=>'پربازدیدترین ها',2=>'محبوب ترین ها',3=>'پرفروش ترین ها',4=>'قیمت',5=>'جدید ترین ها'],null,['class'=>'form-control']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="@if($catSelected=='products') em-hide @endif" id="person_search">

                        <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup6" aria-expanded="true" aria-controls="collapseListGroup6">مشخصات کاربر</a></h3>
                        <div class="collapse in collapse-content" id="collapseListGroup6"  aria-expanded="true">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col- control-label" >نام کاربر</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('username',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >نوع کاربر</label>
                                            <div class="col-sm-8">
                                                {!! Form::select('role',[0=>'اهمیتی ندارد',1=>'حقیقی',2=>'حقوقی'],null,['class'=>'form-control']) !!}
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
                                                {!! Form::select('province',$provinces,null,['id'=>'province_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >شهر</label>
                                            <div class="col-sm-9">
                                                {!! Form::select('city',$cities,null,['id'=>'city_id','class'=>'form-control']) !!}
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
                                                {!! Form::select('firstCat',$firstSkillCat,null,['id'=>'main_category_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >طبقه بندی سطح دوم</label>
                                            <div class="col-sm-7">
                                                {!! Form::select('secondCat',$secondSkillCat,null,['id'=>'sub_category_id','class'=>'form-control']) !!}
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
                                                {!! Form::text('title',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col- control-label" >سطح خود ارزیابی</label>
                                            <div class="col-sm-8">
                                                {!! Form::select('my_rate',[0=>'اهمیتی ندارد',1=>'کاملا حرفه ایی',2=>'قابل قبول',3=>'تازه کار'],null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >استان</label>
                                            <div class="col-sm-9">
                                                {!! Form::select('skillProvince',$provinces,null,['id'=>'skill_province_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col- control-label" >شهر</label>
                                            <div class="col-sm-9">
                                                {!! Form::select('skillCity',$cities,null,['id'=>'skill_city_id','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('experience','experience',null,['class'=>'form-control']) !!}
                                                <label for="experience">داشتن نمونه کار</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('degree','degree',null,['class'=>'form-control']) !!}
                                                <label for="degree">داشتن مدرک گواهینامه</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success checkbox-inline">
                                                {!! Form::checkbox('history','history',null,['class'=>'form-control']) !!}
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
                                                {!! Form::checkbox('status',1,null,['class'=>'form-control']) !!}
                                                <label for="status">فقط مهارت های قابل ارائه</label>
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
                                                {!! Form::select('firstWeekDay',[0=>'اهمیتی ندارد',1=>'شنبه',2=>'یکشنبه',3=>'دوشنبه',4=>'سه شنبه',5=>'چهارشنبه',6=>'پنجشنبه',7=>'جمعه'],null,['id'=>'skill_first_week','class'=>'form-control']) !!}
                                            </div>
                                            <label class="col- control-label" >تا</label>
                                            <div class="col-sm-4">
                                                {!! Form::select('secondWeekDay',[0=>'اهمیتی ندارد',1=>'شنبه',2=>'یکشنبه',3=>'دوشنبه',4=>'سه شنبه',5=>'چهارشنبه',6=>'پنجشنبه',7=>'جمعه'],null,['id'=>'skill_second_week','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <div class="collapse-content">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col- control-label" >مرتب سازی بر اساس</label>
                                            <div class="col-sm-8">
                                                {!! Form::select('userSort',[1=>'سطح مهارت - خوداظهاری',2=>'مدت عضویت'],null,['class'=>'form-control']) !!}


                                                    {{--<option value="2"> نزدیک ترین به من</option>--}}
                                                    {{--<option value="3">سطح مهارت – ارزیابی سایت</option>--}}
                                                    {{--<option value="3">امتیاز گواهینامه</option>--}}

                                                    {{--<option value="3">  میزان سابقه</option>--}}
                                                    {{--<option value="3">میزان تحصیلات</option>--}}
                                                    {{--<option value="3">درصد تکمیل بودن پروفایل</option>--}}
                                                    {{--<option value="3">  تعداد کارهای واگذار شده از طریق سایت</option>--}}
                                                    {{--<option value="3">پیشنهاد ویژه</option>--}}
                                                    {{--<option value="3">سطح مهارت</option>--}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <h3><button type="submit" class="btn btn-default btn-sm">جستجو در سایت</button></h3>




                    </div>


                {!! Form::close() !!}


            </div>
        </div>

    </div>

    @if(isset($userResults) && $userResults!=null)
        @foreach($userResults as $result)
            <div class="search-result">
                <div class="col-sm-3">
                    <div class="search-card">
                        <div class="avatar">
                            <img src="{{ asset('img/persons') }}/{{$result->avatar}}">
                        </div>
                        <div class="name">
                            {{$result->username}}
                        </div>
                        <div class="rate">
                            <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                        </div>
                        <div class="about-me">
                            {{$result->description}}
                        </div>
                        <div class="action text-center">
                            <a href="{{route('home.profile',$result->id)}}" class="btn btn-violet btn-sm "><i class="fa icon-user-1 fa-lg" ></i> پروفایل </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(isset($productResults) && $productResults!=null)
        @foreach($productResults as $result)
            <div class="search-result">
                <div class="col-sm-3">
                    <div class="search-card">
                        <div class="avatar">
                            <img src="{{asset('img/files/shop')}}/{{$result->files()->firstOrFail()->name}}">
                        </div>
                        <div class="name">
                            {{$result->name}}
                        </div>
                        <div class="rate">
                            <div class="item"><i class="fa fa-shopping-cart fa-lg" ></i> {{$result->num_comment}} <span>خرید</span></div>
                            <div class="item"><i class="fa fa-commenting-o fa-lg" ></i> {{$result->num_visit}} <span>دیدگاه</span></div>
                        </div>
                        <div class="about-me">
                            {{$result->description}}
                        </div>
                        <div class="action text-center">
                            <a  href="{{route('home.shop.product',[$result->shop->id,$result->id])}}" type="button" class="btn btn-success btn-sm "><i class="fa icon-shopping-basket fa-lg" ></i>مشخصات کالا</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('script')

    <script>
        //        $("#advance_search_elements").hide();
        $(document).ready(function(){


            $("#toggle_advance").click(function(e){
                e.preventDefault()
                $("#advance_search_elements").slideToggle()
            });

            $('input[type=radio][name=view_d]').change(function() {
                if (this.value == 'products') {
                    $("#person_search").fadeOut('fast', function(){
                        $("#product_search").fadeIn('fast');
                    });
                    console.log('product');
                }
                else if (this.value == 'users') {
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