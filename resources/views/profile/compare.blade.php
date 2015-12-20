@extends('profile.layout')

@section('content')
    @include('profile.partials.compare')
@endsection

@section('side')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection