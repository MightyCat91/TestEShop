<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="header mx-auto">
            <h2>Погода в Брянске</h2>
        </div>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col">
                <div class="city">
                    Брянск
                </div>
            </div>
            <div class="col col-sm">
                <div class="last-update row">
                    <div class="col">Последнее обновление:</div>
                    <div class="col">{{$now}}</div>
                </div>
            </div>
        </div>
        <div class="row div col-3">
            <div class="fact">
                <div class="row">
                    <div class="temp col">{{$fact->temp}}</div>
                    <div class="icon col">
                        <img class="weather_icon" src="https://yastatic
                    .net/weather/i/icons/blueye/color/svg{{$fact->icon}}"/>
                    </div>
                </div>
                <div class="feels_like row col-6">
                    <div class="feels_like_caption">Ощущается:</div>
                    <div class="feels_like_value">{{$fact->feels_like}}</div>
                </div>
                <div class="wind row">
                    <div class="weather_caption">Ветер:</div>
                    <div class="wind_speed">{{$fact->wind_speed}}</div>
                    <div class="wind_dir">{{$fact->wind_dir}}</div>
                </div>
                <div class="pressure row">
                    <div class="pressure_caption">Давление:</div>
                    <div class="pressure_value">
                        {{$fact->pressure_mm}}
                    </div>
                </div>
                <div class="humidity row">
                    <div class="humidity_caption">Влажность:</div>
                    <div class="humidity_value">
                        {{$fact->humidity}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            @foreach($forecast->parts as $day)
                <div class="fact">
                    <div class="row">
                        <div class="temp col">{{$day->temp_avg}}</div>
                        <div class="icon col">
                            <img class="weather_icon" src="https://yastatic
                    .net/weather/i/icons/blueye/color/svg{{$day->icon}}"/>
                        </div>
                    </div>
                    <div class="feels_like row col-6">
                        <div class="feels_like_caption">Ощущается:</div>
                        <div class="feels_like_value">{{$day->feels_like}}</div>
                    </div>
                    <div class="wind row">
                        <div class="weather_caption">Ветер:</div>
                        <div class="wind_speed">{{$day->wind_speed}}</div>
                        <div class="wind_dir">{{$day->wind_dir}}</div>
                    </div>
                    <div class="pressure row">
                        <div class="pressure_caption">Давление:</div>
                        <div class="pressure_value">
                            {{$day->pressure_mm}}
                        </div>
                    </div>
                    <div class="humidity row">
                        <div class="humidity_caption">Влажность:</div>
                        <div class="humidity_value">
                            {{$day->humidity}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="mx-auto">
                <button class="weather_reload button">Обновить</button>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>