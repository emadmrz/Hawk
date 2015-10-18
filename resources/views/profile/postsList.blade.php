@extends('profile.layout')

@section('content')
    @include('partials.postsList',['canEdit'=>1])
@endsection

@section('side')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection