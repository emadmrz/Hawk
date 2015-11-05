@extends('group.layout')
@section('side')
    @include('group.partials.allMembers')
    @include('group.partials.sideProblem')
    @include('group.partials.latestPosts')
    @include('group.partials.latestProblems')
@endsection
@section('content')
    @include('partials.problemPreview')
@endsection
@section('script')
@endsection