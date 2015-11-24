@extends('home.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('content')
    @include('store.offer.invoice')
@endsection

@section('side')
    @include('home.partials.latestArticles')
    @include('home.partials.latestPosts')
@endsection