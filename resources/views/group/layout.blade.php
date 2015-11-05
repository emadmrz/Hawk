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
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/crop/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

</head>
<body>

<header id="profile-header" class="profile-header">

    @include('partials.navbar')
    @include('group.partials.cover')

</header>

<main>

    <div class="container">
        <div class="row">

            <div class="col-sm-3 pull-right">
                @yield('side')
            </div>
            <div class="col-sm-9 pull-right">

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
<script src="{{ asset('js/cropper.js') }}"></script>
<script src="{{ asset('js/crop/main.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
<script src="{{ asset('js/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('js/summernote/summernote-fa-IR.js') }}"></script>
<script src="{{ asset('js/jquery.flexText.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/circle-progress.js') }}"></script>
<script src="{{ asset('js/magnifying.js') }}"></script>

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

        $("div.skills-tab .tab-content").niceScroll({
            railalign : 'left',
            cursorcolor : '#EEE',
            railpadding: {
                top: 0,
                right: 5,
                left: 0,
                bottom: 0
            }
        });

        $("div.skill-panel.fixed-height .skill-panel-body").niceScroll({
            railalign : 'left',
            cursorcolor : '#8456A7',
            railpadding: {
                top: 0,
                right: 2,
                left: 0,
                bottom: 0
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