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
                {{ $poll->title }}
            </div>
            <div class="panel-body">
                <p>
                    {{ $poll->question }}
                </p>
                {!! Form::open(['route'=>['home.poll.vote', $poll->id], 'data-remote-multiple']) !!}
                    @foreach($parameters as $parameter)
                        <div class="form-group" id="parameter_{{ $parameter->id }}">
                            <div class="radio radio-success radio-inline vote-radio">
                                <input type="radio" id="inlineRadio{{ $parameter->id }}" value="{{ $parameter->id }}" name="vote" >
                                <label for="inlineRadio{{ $parameter->id }}">{{ $parameter->name }}</label>
                            </div>
                            <div class="progress">
                                <div class="progress-bar pull-right progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ round($parameter->num_vote*100/$total_votes,2) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round($parameter->num_vote*100/$total_votes,2) }}%">@if($parameter->num_vote) {{ round($parameter->num_vote*100/$total_votes,2) }}% @endif</div>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-hand-pointer-o"></i> ثبت رای </button>
                    </div>
                {!! Form::close() !!}
                <p style="color: #999">
                    {{ $poll->description }}
                </p>
            </div>
        </div>
    </div>
@endsection