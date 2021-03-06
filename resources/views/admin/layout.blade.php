<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
</head>
<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ $title }}</h1>
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @include('flash::message')
                </div>
            </div>
        </div>

        @yield('content')

    </div>


</div>


<script src="{{ asset('js/admin/jquery.min.js') }}"></script>
<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/admin/metisMenu.min.js') }}"></script>
<script src="{{ asset('js/admin/sb-admin-2.js') }}"></script>
{{--added by Dara morris dependencies--}}
<script src="{{ asset('js/admin/raphael-min.js') }}"></script>
<script src="{{ asset('js/admin/morris.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.fa.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('a[data-delete-confirm]').click(function () {
            if (!confirm('Are you sure you want to delete this record from database')) {
                return false;
            }
        });

        $('a[data-post-active]').click(function () {
            if (!confirm('Are you sure you want to active this record from database')) {
                return false;
            }
        });

        $('a[data-post-ban]').click(function () {
            if (!confirm('Are you sure you want to ban this record from database')) {
                return false;
            }
        });
    });
</script>


@yield('script')

</body>
</html>