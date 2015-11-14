@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                گزارش
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.report.store']]) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('title','نوع خطا :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('title',\Illuminate\Support\Facades\Config::get('report.title'),null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <input name="type" type="hidden" value="{{$type}}">
                    <input name="id" type="hidden" value="{{$id}}">
                    <div class="form-group panel-form">
                        {!! Form::label('description','توضیحات :',['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-7">
                            <textarea name="description" id="flex_textarea" class="form-control share-text" rows="3" placeholder="توضیحات مربوط را وارد نمایید ..."></textarea>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i>ثبت گزارش</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection