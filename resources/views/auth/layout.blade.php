<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
</head>
<body  class="site-login">

<main>
    <div class="container">
        <div class="row">

            @yield('content')

        </div>
    </div>
</main>



<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/validator.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/bootstrap-show-password.js') }}"></script>
<script src="{{ asset('js/auto_direction.js') }}"></script>

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
</html>