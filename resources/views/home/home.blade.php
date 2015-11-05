@extends('home.layout')

@section('header')
    @include('partials.navbar')

@endsection

@section('content')
    @include('profile.partials.post',['route'=>'user'])
    @foreach($feeds as $feed)
        {!! $feed !!}
    @endforeach
@endsection

@section('side')

@endsection

@section('full')

@endsection

