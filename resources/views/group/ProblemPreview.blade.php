@extends('group.layout')
@section('side')
    @include('group.partials.addProblem')
    {{--@include('group.partials.sideProblem')--}}
    @include('group.partials.latestPosts')
    @include('group.partials.latestProblems')
    @include('group.partials.allMembers')
@endsection
@section('content')
    @include('partials.problemPreview')
@endsection
@section('script')
@endsection