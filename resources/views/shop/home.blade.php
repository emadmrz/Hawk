@extends('shop.layout')

@section('content')

    @include('shop.partials.slider')
    @include('shop.partials.commercial')

    <div class="content">

        @include('shop.partials.productBox')
        @include('shop.partials.statistics')

        <div class="clearfix"></div>
    </div>

@endsection