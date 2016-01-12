@extends('profile.layout')

@section('side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    @include('store.recruitment.partials.recruitmentRequesterPreview')
@endsection
@section('script')
    <script>

    </script>
@endsection