@extends('profile.layout')
@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                ثبت خدمت
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.offer.service.create',$offer->id],'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('title','عنوان :') !!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('image','تصویر :') !!}
                    {!! Form::file('image') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','توضیحات :') !!}
                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('expired_at','تاریخ انقضا') !!}
                    {!! Form::input('date','expired_at',Carbon\Carbon::now()->format('Y-m-d'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-add" type="submit">ثبت</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                افزودن کوپن به خدمت
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.management.addon.offer.service.coupon.create','offer'=>$offer->id],'data-remote'=>'add_coupon']) !!}
                <div class="form-group panel-form">
                    {!! Form::label('offer','انتخاب خدمت :') !!}
                    {!! Form::select('offer',$specialOffers,null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group panel-form">
                    {!! Form::label('title','عنوان :') !!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group panel-form">
                    {!! Form::label('real_amount','ارزش واقعی :') !!}
                    {!! Form::input('number','real_amount',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group panel-form">
                    {!! Form::label('pay_amount','مبلغ قابل پرداخت :') !!}
                    {!! Form::input('number','pay_amount',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group panel-form">
                    {!! Form::label('description','توضیحات :') !!}
                    {!! Form::text('description',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group panel-form">
                    {!! Form::label('num','تعداد :') !!}
                    {!! Form::input('number','num',0,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> افزودن</button>
                </div>
                {!! Form::close() !!}
                <table class="table table-striped text-right editable-table" id="coupon_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >خدمت</th>
                        <th  class="text-right" >تعداد</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td width="30%" ><a href="#" data-editable id="title" data-type="text" data-pk="{{ $coupon->id }}">{{ $coupon->title }}</a></td>
                            <td width="50%" ><a href="#" data-editable id="description" data-type="textarea" data-pk="{{ $coupon->id }}">{{ $coupon->description }}</a></td>
                            <td width="50%" ><a href="#" id="service" data-type="text" data-pk="{{ $coupon->id }}">{{ $coupon->coupon_gallery->title }}</a></td>
                            <td width="15%" ><a href="#" data-editable id="num" data-type="text" data-pk="{{$coupon->id}}">{{$coupon->num}}</a></td>
                            <td width="5%" ><button id="delete_coupon" data-value="{{$coupon->id}}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>

    @endsection