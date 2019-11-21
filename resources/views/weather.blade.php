@extends('welcome')
@section('weather_active', 'active')
@section('content')
<div class="weather_container container">
    <div class="row">
        <div class="header mx-auto">
            <h2>Погода в Брянске</h2>
        </div>
    </div>
    <div class="wrapper">
        <div class="flex-row weather-header">
            <div class="last_update flex-row">
                <div>Последнее обновление:</div>
                <div>{{$now}}</div>
            </div>
            <a class="weather_reload" href="{{route('weather')}}">Обновить</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="fact">
                <div class="flex-row">
                    <div class="col-lg-6 col-md-6 col-sm-8">
                        <div class="temp">{{$fact['temp']}}°C</div>
                        <div class="feels_like flex-row">
                            <div class="feels_like_caption">Ощущается:</div>
                            <div class="feels_like_value">{{$fact['feels_like']}}°C</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-4">
                        <div class="city">Брянск</div>
                        <img class="weather_icon"
                             src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{$fact['icon']}}.svg"/>
                    </div>
                </div>
                <div class="wind flex-row">
                    <div class="wind_caption">Ветер:</div>
                    <div class="wind_speed">{{$fact['wind_speed']}} м/с</div>
                    <div class="wind_dir">{{$fact['wind_dir']}}</div>
                </div>
                <div class="pressure flex-row">
                    <div class="pressure_caption">Давление:</div>
                    <div class="pressure_value">{{$fact['pressure']}} мм.рт.ст.</div>
                </div>
                <div class="humidity flex-row">
                    <div class="humidity_caption">Влажность:</div>
                    <div class="humidity_value">{{$fact['humidity']}} %</div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-6 col-xl-9">
            <div class="forecasts flex-row">
                <div class="forecasts_scroll">
                    @foreach($forecasts as $part)
                        <div class="forecast">
                            <div class="forecast_day">
                                <div>{{$part['date']}}</div>
                            </div>
                            <div class="flex-row ">
                                <div class="day">
                                    <div class="part">День</div>
                                    <div class="space flex-row">
                                        <div class="forecast_temp">{{$part['day']['temp']}}°C</div>
                                        <img class="forecast_icon"
                                             src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{$part['day']['icon']}}.svg"/>
                                    </div>
                                    <div class="temp_min flex-row">
                                        <div class="temp_min_caption">Минимум:</div>
                                        <div class="temp_min_value">{{$part['day']['temp_min']}}°C</div>
                                    </div>
                                    <div class="prec_mm flex-row">
                                        <div class="prec_mm_caption">Осадки:</div>
                                        <div class="prec_mm_value">{{$part['day']['prec_mm']}} мм.</div>
                                    </div>
                                    <div class="forecast_humidity flex-row">
                                        <div class="forecast_humidity_caption">Влажность:</div>
                                        <div class="forecast_humidity_value">{{$part['day']['humidity']}} %</div>
                                    </div>
                                </div>
                                <div class="night">
                                    <div class="part">Ночь</div>
                                    <div class="space flex-row">
                                        <div class="forecast_temp">{{$part['night']['temp']}}°C</div>
                                        <img class="forecast_icon"
                                             src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{$part['night']['icon']}}.svg"/>
                                    </div>
                                    <div class="prec_mm flex-row">
                                        <div class="prec_mm_caption">Осадки:</div>
                                        <div class="prec_mm_value">{{$part['night']['prec_mm']}} мм.</div>
                                    </div>
                                    <div class="forecast_humidity flex-row">
                                        <div class="forecast_humidity_caption">Влажность:</div>
                                        <div class="forecast_humidity_value">{{$part['night']['humidity']}} %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection