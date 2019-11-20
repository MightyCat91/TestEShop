<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPSTORM_META\map;

const LAT = 53.243325;
const LON = 34.363731;

class WeatherController extends Controller
{
    private function callAPI()
    {
        $curl = curl_init();

        $url = "https://api.weather.yandex.ru/v1/forecast?lat=" . LAT . "&lon=" . LON;
        $proxy = 'proxy.krista.ru:8080';
        $proxyauth = 'muzhilkin:2Pv2qu4hkBwD';

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_PROXY, $proxy);     // PROXY details with port
        curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyauth);   // Use if proxy have username and password
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Yandex-API-Key: 21249a78-be7c-4728-b482-75a5dddb5f4a',
        ));


        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            dump("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    private function getWeather()
    {
        $json = $this->callAPI();
        return json_decode($json, true);
    }

    private function getWindDir($dir)
    {
        switch ($dir) {
            case "nw":
                $ldir = "северо-западное";
                break;
            case "n":
                $ldir = "северное";
                break;
            case "ne":
                $ldir = "северо-восточное";
                break;
            case "e":
                $ldir = "восточное";
                break;
            case "se":
                $ldir = "юго-восточное";
                break;
            case "s":
                $ldir = "южное";
                break;
            case "sw":
                $ldir = "юго-западное";
                break;
            case "w":
                $ldir = "западное";
                break;
            default:
                $ldir = "штиль";
                break;
        }
        return $ldir;
    }

    private function getWeatherFactOptions($weather)
    {
        return [
            'temp' => $weather['temp'],
            'icon' => $weather['icon'],
            'feels_like' => $weather['feels_like'],
            'wind_speed' => $weather['wind_speed'],
            'wind_dir' => $this->getWindDir($weather['wind_dir']),
            'pressure' => $weather['pressure_mm'],
            'humidity' => $weather['humidity']
        ];
    }

    private function getWeatherForecastsOptions($weather)
    {
        $callbackFunc = function ($value) {
            $day = $value['parts']['day_short'];
            $night = $value['parts']['night_short'];
            return [
                'date' => date('d.m', $value['date_ts']),
                'day' => [
                    'temp_min' => $day['temp_min'],
                    'temp' => $day['temp'],
                    'icon' => $day['icon'],
                    'humidity' => $day['humidity'],
                    'prec_mm' => $day['prec_mm'],
                ],
                'night' => [
                    'temp' => $night['temp'],
                    'icon' => $night['icon'],
                    'humidity' => $night['humidity'],
                    'prec_mm' => $night['prec_mm'],
                ]
            ];
        };
        return array_map($callbackFunc, $weather);

    }

    public function show()
    {
        $weather = $this->getWeather();
        return view("weather", [
            'now' => date('d/m/Y H:m', $weather['now']),
            'fact' => $this->getWeatherFactOptions($weather['fact']),
            'forecasts' => $this->getWeatherForecastsOptions($weather['forecasts'])
        ]);
    }
}
