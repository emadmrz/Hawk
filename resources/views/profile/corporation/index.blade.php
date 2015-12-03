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
                        <div class="radio">
                            <input type="radio" name="status" id="radio1" value="1" checked="">
                            <label for="radio1">
                                تایید
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="radio">
                            <input type="radio" name="status" id="radio2" value="0" checked="">
                            <label for="radio2">
                                لغو
                            </label>
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