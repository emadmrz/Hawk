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
                    @foreach($questionnaire->questions()->get() as $key=>$question)
                        <div class="form-group questionnaire_result_list" id="option_{{ $question->id }}">
                            <p>{{ $question->title }}</p>
                            @foreach($question->options()->get() as $option)
                                <div>
                                    <label>{{ $option->name }}</label> &ensp; [{{ $option->num_vote }}]
                                    <div class="progress">
                                        <div class="progress-bar pull-right progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="{{ round($option->num_vote*100/$total_ticks[$question->id],2) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round($option->num_vote*100/$total_ticks[$question->id],2) }}%">@if($option->num_vote) {{ round($option->num_vote*100/$total_ticks[$question->id],2) }}% @endif</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                <p style="color: #999">
                    {{ $questionnaire->description }}
                </p>
                @can('export-questionnaire',$questionnaire)
                    <a href="{{ route('profile.management.addon.questionnaire.export',$questionnaire->id) }}" class="btn btn-violet btn-sm">دریافت نتایج در قالب xlsx</a>
                @endcan
            </div>
        </div>
    </div>
@endsection