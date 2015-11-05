@extends('group.layout')
@section('side')
    @include('group.partials.allMembers')
    @include('group.partials.sideProblem')
    @include('group.partials.latestPosts')
    @include('group.partials.latestProblems')
@endsection
@section('content')
    @include('profile.partials.post',['route'=>'group','group'=>$group])

    @foreach($feeds as $feed)
        {!! $feed !!}
    @endforeach
@endsection
@section('script')
@endsection