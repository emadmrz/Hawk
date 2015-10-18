@extends('profile.layout')

@section('content')
    @include('partials.postPreview',['canEdit'=>1])
@endsection

@section('side')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection