@extends('profile.layout')

@section('content')
    @include('partials.articlesList',['canEdit'=>1])
@endsection

@section('side')
    @include('profile.partials.latestArticles')
@endsection