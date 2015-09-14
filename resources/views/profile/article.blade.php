@extends('profile.layout')

@section('content')
    @include('profile.partials.article')
@endsection

@section('side')
    @include('profile.partials.latestArticles')
@endsection