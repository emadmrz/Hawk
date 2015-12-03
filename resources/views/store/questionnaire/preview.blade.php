@extends('home.layout')

@section('header')
    @include('partials.navbar')
    @include('home.partials.cover')
@endsection

@section('side')

@endsection

@section('content')
    @include('partials.questionnairePreview')
@endsection