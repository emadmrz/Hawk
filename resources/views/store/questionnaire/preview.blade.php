@extends('home.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('side')

@endsection

@section('content')
    <div class="timeline-block" id="add_new_post">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                {{ $questionnaire->title }}
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>['home.questionnaire.tick', $questionnaire->id]]) !!}
                    @foreach($questionnaire->questions()->get() as $key=>$question)
                        <div class="form-group questionnaire_questions_list" id="option_{{ $question->id }}">
                            <div class="numbering">{{ $key+1 }}</div>
                            <p>{{ $question->title }}</p>
                            @foreach($question->options()->get() as $option)
                                <div class="radio radio-success radio-inline tick-radio">
                                    <input type="radio" id="inlineOption{{ $option->id }}" value="{{ $option->id }}" name="tick[{{ $question->id }}]" >
                                    <label for="inlineOption{{ $option->id }}">{{ $option->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-hand-pointer-o"></i> ارسال پاسخ پرسشنامه </button>
                        @if($questionnaire->show_result)
                            <a href="{{ route('home.questionnaire.result',[$questionnaire->user_id, $questionnaire->id]) }}" class="pull-left btn btn-violet btn-sm">مشاهده نتایج پرسشنامه</a>
                        @endif
                    </div>
                {!! Form::close() !!}
                <p style="color: #999">
                    {{ $questionnaire->description }}
                </p>
            </div>
        </div>
    </div>
@endsection