@extends('home.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('content')
    @include('partials.postPreview',['canEdit'=>0])
@endsection

@section('side')
    @include('home.partials.latestArticles')
    @include('home.partials.latestPosts')
@endsection