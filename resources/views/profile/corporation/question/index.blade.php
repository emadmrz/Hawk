@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                تکمیل پرسشنامه
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.corporation.question.submit',$corporation->id]]) !!}
                @foreach($questions as $key=>$question)
                    <span>{{$key+1}} -</span> <span>{{$question->content}}</span>
                    <div class="form-group">
                        <div class="radio radio-inline">
                            {!! Form::radio("status".$question->id,4,['class'=>'form-control']) !!}
                            <label for="status">عالی</label>
                        </div>
                        <div class="radio radio-inline">
                            {!! Form::radio("status".$question->id,3,['class'=>'form-control']) !!}
                            <label for="status">خوب</label>
                        </div>
                        <div class="radio radio-inline">
                            {!! Form::radio("status".$question->id,2,['class'=>'form-control']) !!}
                            <label for="status">متوسط</label>
                        </div>
                        <div class="radio radio-inline">
                            {!! Form::radio("status".$question->id,1,['class'=>'form-control']) !!}
                            <label for="status">ضعیف</label>
                        </div>
                    </div>
                @endforeach
                <div class="form-group pull-left">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>ارسال</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection