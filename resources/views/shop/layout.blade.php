<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('css/raterater.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
</head>
<body>

{{--<div class="color-selector">--}}
    {{--<ul>--}}
        {{--<li><a href="#" data-color="danger" style="background: red" ></a></li>--}}
        {{--<li><a href="#" data-color="violet" style="background: darkviolet"></a></li>--}}
        {{--<li><a href="#" data-color="success" style="background: green"></a></li>--}}
        {{--<li><a href="#" data-color="primary" style="background: blue"></a></li>--}}
        {{--<li><a href="#" data-color="info" style="background: cornflowerblue"></a></li>--}}
    {{--</ul>--}}
{{--</div>--}}

<header id="profile-header" class="profile-header">

    @include('partials.navbar')

</header>

<main class="{{ $shop->theme }}" >
    <div class="container">

        <!--===============Top Bar====================-->

        @include('shop.partials.topBar')

        <!--===============Header Menu====================-->

        @include('shop.partials.headerMenu')

        @yield('content')


    </div>
</main>

@include('shop.partials.footer')


<script src="{{ asset('js/jquery.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
{{--<script src="{{ asset('js/profile.js') }}"></script>--}}
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/magnifying.js') }}"></script>
<script src="{{ asset('js/shop.js') }}"></script>
<script src="{{ asset('js/raterater.js') }}"></script>

<script>
    function rateAlert(id, rating)
    {
        alert( 'Rating for '+id+' is '+rating+' stars!' );
    }

    /* Here we initialize raterater on our rating boxes
     */
    $(function() {
        $( '.shop-rate' ).raterater( {
            submitFunction: 'rateAlert',
            allowChange: true,
            starWidth: 16,
            spaceWidth: 2,
            numStars: 5
        } );
        $( '.service-rate' ).raterater( {
            submitFunction: 'rateAlert',
            allowChange: true,
            starWidth: 16,
            spaceWidth: 2,
            numStars: 5
        } );
        $( '.product-rate' ).raterater( {
            submitFunction: 'rateAlert',
            allowChange: true,
            starWidth: 16,
            spaceWidth: 2,
            numStars: 5
        } );
    });
</script>

<script>
    $(document).ready(function(){
        $('.color-selector li a').click(function(e){
            e.preventDefault()
            var color = $(this).attr('data-color');
            console.log(color);
            var current = $('main').attr('class');
            console.log(current);
            $('main').removeAttr('class').addClass(color);
            $('button').removeClass('btn-'+current).addClass('btn-'+color);
        })
    })
</script>

@section('script')

@endsection

</body>
</html>