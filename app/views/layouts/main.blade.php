<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iagr.ee</title>
    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}" media="screen">
    <script src="{{ asset('/js/vendor/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/modernizr-2.6.2.min.js') }}"></script>
</head>
<body>
    @yield('content')
</body>
</html>