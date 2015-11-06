@extends('group.layout')
@section('side')
    @can('join-group', $group)
        {!! Form::open(['route'=>['group.join',$group->id],'id'=>'join-group']) !!}
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-group fa-lg"></i> پیوستن به گروه </button>
            </div>
        {!! Form::close() !!}
    @endcan
    @include('group.partials.addProblem')
    {{--@include('group.partials.sideProblem')--}}
    @include('group.partials.latestPosts')
    @include('group.partials.latestProblems')
    @include('group.partials.allMembers')
    @cannot('join-group', $group)
        {!! Form::open(['route'=>['group.leave',$group->id],'id'=>'leave-group']) !!}
            <div class="form-group">
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-power-off fa-lg"></i> ترک کردن گروه </button>
            </div>
        {!! Form::close() !!}
    @endcan
@endsection
@section('content')
    @include('profile.partials.post',['route'=>'group','group'=>$group])

    @foreach($feeds as $feed)
        {!! $feed !!}
    @endforeach
@endsection
@section('script')
@endsection