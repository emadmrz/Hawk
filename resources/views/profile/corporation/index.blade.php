@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                همکاری با
                <a href="{{route('home.profile',[$corporation->sender_id])}}">{{$corporation->sender->username}}</a>
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.corporation.submit',$corporation->id]]) !!}
                <div class="clearfix form-horizontal">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="radio radio-inline">
                                {!! Form::radio('status',1,true,['class'=>'form-control']) !!}
                                <label for="status">موافقم</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="radio radio-inline">
                                {!! Form::radio('status',0,['class'=>'form-control']) !!}
                                <label for="status">لغو</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>ثبت</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection