@extends('profile.layout')

@section('content')
    @include('profile.partials.post')
    @include('profile.partials.info')
    @role('user')
        @include('profile.partials.education')
    @endrole
    @include('profile.partials.biography')
@endsection

@section('side')
    @include('profile.partials.latestArticles')
@endsection

@section('script')
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=fa"></script>
@endsection