<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

const LAT = 53;
const LON = 34;

class WeatherController extends Controller
{
    private function callAPI()
    {
        $curl = curl_init();

        $url = "https://api.weather.yandex.ru/v1/informers?lat=" . LAT . "&lon=" . LON;
        $proxy = 'proxy.krista.ru:8080';
        $proxyauth = 'muzhilkin:2Pv2qu4hkBwD';

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_PROXY, $proxy);     // PROXY details with port
        curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxyauth);   // Use if proxy have username and password
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Yandex-API-Key: 21249a78-be7c-4728-b482-75a5dddb5f4a',
            'Content-Type: application/json',
        ));

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    private function getWeather()
    {
        $json = $this->callAPI();
        dd($json);
        return json_decode($json, true);
    }

    public function show()
    {
        $weather = $this->getWeather();
        return view("weather", [
            'now' => date('d/m/Y h/m', $weather->now),
            'fact' => $weather->fact,
            'forecast' => $weather->forecast
        ]);
    }
}
