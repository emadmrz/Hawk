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
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/raterater.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toggle-switch.css') }}">


</head>
<body>

<header id="profile-header" class="profile-header">

    @yield('header')

</header>

<main>

    <div class="container">
        <div class="row">

            <div class="col-sm-12">

                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                @include('flash::message')

                @yield('content')

            </div>


        </div>
    </div>

</main>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/jquery.flexText.min.js') }}"></script>
<script src="{{ asset('js/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('js/summernote/summernote-fa-IR.js') }}"></script>
<script src="{{ asset('js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/circle-progress.js') }}"></script>
<script src="{{ asset('js/raterater.js') }}"></script>

<script>
    $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip()

        $.notifyDefaults({
            delay: 5000,
            timer: 100,
            offset: {
                x: 10,
                y:60
            },
            placement: {
                from: "bottom",
                align: "right"
            },
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            }
        });


        $('#skill-carousel').carousel({
            interval: false
        });

    });


    $('#circle_progress').circleProgress({
        size: 190 ,
        thickness : 25,
        lineCap: 'round',
        animation: {duration: 4000},
        fill: { color: '#8456A7' }
    }).on('circle-animation-progress', function(event, progress, stepValue) {
//            $(this).find('strong').html(parseInt( progress) + '<i>%</i>');
        $(this).find('strong').html( (stepValue*100).toFixed(1)+ '<i>%</i>' );

    });
</script>

@yield('script')

</body>