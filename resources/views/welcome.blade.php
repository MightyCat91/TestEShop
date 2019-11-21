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
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class='@yield('weather_active')'><a href="{{route("weather")}}">Погода</a></li>
                <li class='@yield('orders_active')'><a href="{{route("current_orders")}}">Заказы</a></li>
                <li class='@yield('products_active')'><a href="{{route("products")}}">Товары</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
