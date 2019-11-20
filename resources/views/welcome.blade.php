<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li class="active"><a href="{{route("weather")}}">Погода</a></li>
        <li><a href="{{route("current_orders")}}">Заказы</a></li>
        <li><a href="{{route("products")}}">Товары</a></li>
    </ul>
</div>
@yield('content')
<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>
