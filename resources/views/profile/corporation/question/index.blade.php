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
                            <input type="radio" name="answer[{{ $question->id }}]" id="radio1_{{ $question->id }}" value="1" checked="">
                            <label for="radio1_{{ $question->id }}">بهتر از انتظار</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="answer[{{ $question->id }}]" id="radio2_{{ $question->id }}" value="2">
                            <label for="radio2_{{ $question->id }}">خوب</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="answer[{{ $question->id }}]" id="radio3_{{ $question->id }}" value="3">
                            <label for="radio3_{{ $question->id }}">معمولی</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="answer[{{ $question->id }}]" id="radio4_{{ $question->id }}" value="4">
                            <label for="radio4_{{ $question->id }}">بد</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="answer[{{ $question->id }}]" id="radio5_{{ $question->id }}" value="5">
                            <label for="radio5_{{ $question->id }}">افتضاح</label>
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