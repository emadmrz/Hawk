@extends('profile.layout')

@section('content')
    @include('profile.partials.article')
@endsection

@section('side')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection