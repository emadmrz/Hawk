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
                {!! Form::model($service,['route'=>['profile.management.addon.offer.service.create'],'files'=>true]) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('title','عنوان :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('title',null,['class'=>'form-control']) !!}
                        </div>

                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('image','تصویر :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-5">
                            {!! Form::file('image') !!}
                        </div>

                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('description','توضیحات :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group panel-form">
                        {!! Form::label('expired_at','تاریخ انقضا',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::input('date','expired_at',$service->expired_at,['class'=>'form-control']) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> ثبت خدمت</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection