<!DOCTYPE html>
<html>

<head>
    <title>Energeek</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    @yield('content')
    <script src="{{ asset('vendor/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/swal2/sweetalert2@11.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>

    @yield('scripts')
</body>

</html>
