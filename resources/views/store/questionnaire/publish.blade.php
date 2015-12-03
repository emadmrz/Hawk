@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')

    @if($hasFilters)
        <div class="">
            <div class="panel panel-default share clearfix-xs  search-panel">
                <div class="panel-heading panel-heading-gray title">
                    جستجو و انتخاب دریافت کنندگان نظر سنجی
                </div>
                <div class="panel-body search-box">


                    {!! Form::open(['route'=>['profile.management.addon.questionnaire.search', $questionnaire->id],'method'=>'post', 'class'=>'form-horizontal']) !!}

                    <h3><a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup6" aria-expanded="true" aria-controls="collapseListGroup6">مشخصات کاربر</a></h3>

                    <div class="collapse in collapse-content" id="collapseListGroup6"  aria-expanded="true">

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="col-sm-5">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >نام کاربر</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('username',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >نوع کاربر</label>
                                        <div class="col-sm-8">
                                            {!! Form::select('role',[0=>'اهمیتی ندارد',1=>'حقیقی',2=>'حقوقی'],null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group form-group-sm">
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


                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
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
                                    <div class="form-group  form-group-sm">
                                        <label class="col- control-label" >استان</label>
                                        <div class="col-sm-9">
                                            {!! Form::select('province',$provinces,null,['id'=>'province_id','class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group  form-group-sm">
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
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >طبقه بندی سطح اول</label>
                                        <div class="col-sm-7">
                                            {!! Form::select('firstCat',$firstSkillCat,null,['id'=>'main_category_id','class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >طبقه بندی سطح دوم</label>
                                        <div class="col-sm-7">
                                            {!! Form::select('secondCat',$secondSkillCat,null,['id'=>'sub_category_id','class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group  form-group-sm">
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
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >عنوان مهارت</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('title',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >سطح خود ارزیابی</label>
                                        <div class="col-sm-8">
                                            {!! Form::select('my_rate',[0=>'اهمیتی ندارد',1=>'کاملا حرفه ایی',2=>'قابل قبول',3=>'تازه کار'],null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>




                                <div class="col-sm-3">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >استان</label>
                                        <div class="col-sm-9">
                                            {!! Form::select('skillProvince',$provinces,null,['id'=>'skill_province_id','class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group form-group-sm">
                                        <label class="col- control-label" >شهر</label>
                                        <div class="col-sm-9">
                                            {!! Form::select('skillCity',$cities,null,['id'=>'skill_city_id','class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>




                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm">
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            {!! Form::checkbox('experience','experience',null,['class'=>'form-control']) !!}
                                            <label for="experience">داشتن نمونه کار</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm">
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            {!! Form::checkbox('degree','degree',null,['class'=>'form-control']) !!}
                                            <label for="degree">داشتن مدرک گواهینامه</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm">
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            {!! Form::checkbox('history','history',null,['class'=>'form-control']) !!}
                                            <label for="inlineCheckbox8">داشتن سابقه</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm">
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox10" value="option1">
                                            <label for="inlineCheckbox10"> داشتن ارزیابی</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group form-group-sm">
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
                                    <div class="form-group form-group-sm">
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
                                    <div class="form-group form-group-sm">
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

                    {!! Form::close() !!}


                </div>
                <div class="panel-footer text-footer">
                    <i class="fa fa-clock-o fa-lg" ></i>
                </div>
            </div>
        </div>
    @endif


    @if(isset($results) and count($results))
        {!! Form::open(['route'=>['profile.management.addon.questionnaire.publish', $questionnaire->id],'method'=>'post', 'class'=>'form-horizontal']) !!}
        @foreach($results as $result)
            <table class="table table-striped search-result-table">
                <tbody>
                <tr>
                    <td width="5%">
                        <div class="checkbox checkbox-success">
                            <input id="checkbox3" name="receiver[]" value="{{ $result->id }}" class="styled" type="checkbox">
                            <label for="checkbox3"></label>
                        </div>
                    </td>
                    <td width="10%"><img src="{{ asset('img/persons/'.$result->avatar) }}" class="img-responsive img-circle" ></td>
                    <td width="20%">{{ $result->username }}</td>
                    <td width="20%">
                        <div class="rate">
                            <div class="user-rate ltr" data-id="1" data-rating="2.2"></div>
                        </div>
                    </td>
                    <td width="40%">{{ $result->description }}</td>
                    <td width="10%"><a target="_blank" href="{{ route('home.profile', $result->id) }}" class="btn btn-default btn-xs">مشاهده پروفایل</a> </td>
                </tr>
                </tbody>
            </table>
        @endforeach

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">انتشار نظر سنجی برای کاربران انتخابی</button>
        </div>
        {!! Form::close() !!}
    @endif


    <p class="alert alert-warning">
        فراموش نکنید! پس از انتشار نظر سنجی در بین کاربران، امکان ویرایش مجدد نظر سنجی وجود ندارد. پس قبل از انتشار آن تمامی موارد را درنظر گرفته سپس نظر سنجی را منتشر نمایید.
    </p>
@endsection

@section('script')
    <script src="{{ asset('js/raterater.js') }}"></script>
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