<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
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
</head>
<body>

<header id="profile-header" class="profile-header">

    @include('partials.navbar')
    @include('profile.partials.cover')

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
<script src="{{ asset('js/profile.js') }}"></script>

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
    });
</script>

@yield('script')

</body>