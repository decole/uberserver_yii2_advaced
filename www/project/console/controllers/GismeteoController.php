<?php

namespace console\controllers;

use common\models\WeatherGismeteo;
use yii\console\Controller;

class GismeteoController extends Controller
{
    public function actionIndex() {
        // https://www.gismeteo.ru/api/#kind
        $this->alert('weather now');
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'X-Gismeteo-Token' => '5e21a0d4859496.93956314'
            ],
        ]);
        $response = $client->request('GET', 'https://api.gismeteo.net/v2/weather/current/5064/?lang=ru');
        $content = json_decode($response->getBody(), true);

        $pressure            = $content['response']['pressure']['mm_hg_atm'];
        $temperature_comfort = $content['response']['temperature']['comfort']['C'];
        $temperature_air     = $content['response']['temperature']['air']['C'];
        $humidity            = $content['response']['humidity']['percent'];
        $description         = $content['response']['description']['full'];
        $wind_scale          = $content['response']['wind']['direction']['scale_8'];
        $wind_speed          = $content['response']['wind']['speed']['m_s'];

//        $this->info('Pressure: ' . $pressure);
//        $this->info('temperature_comfort: ' . $temperature_comfort);
//        $this->info('temperature_air: ' . $temperature_air);
//        $this->info('humidity: ' . $humidity);
//        $this->info('description: ' . $description);
//        $this->info('wind_scale: ' . $wind_scale);
//        $this->info('wind_speed: ' . $wind_speed);
//
//        $this->alert('weather tomorrow');
//        $response = $client->request('GET', 'https://api.gismeteo.net/v2/weather/forecast/aggregate/5064/?days=3&lang=ru');
//        $content = json_decode($response->getBody(), true);
//        $day = $content['response'][0];
//        $temperature_comfort_min = $day['temperature']['comfort']['min']['C'];
//        $temperature_comfort_max = $day['temperature']['comfort']['max']['C'];
//        $temperature_air_min     = $day['temperature']['air']['min']['C'];
//        $temperature_air_max     = $day['temperature']['air']['max']['C'];
//        $description             = $day['description']['full'];
//        $wind_scale_min          = $day['wind']['direction']['min']['scale_8'];
//        $wind_scale_max          = $day['wind']['direction']['max']['scale_8'];
//        $wind_speed_min          = $day['wind']['speed']['min']['m_s'];
//        $wind_speed_max          = $day['wind']['speed']['max']['m_s'];
//
//        $this->info('$temperature_comfort_min: ' . $temperature_comfort_min);
//        $this->info('$temperature_comfort_max: ' . $temperature_comfort_max);
//        $this->info('$temperature_air_min: ' . $temperature_air_min);
//        $this->info('$temperature_air_max: ' . $temperature_air_max);
//        $this->info('$description: ' . $description);
//        $this->info('$wind_scale_min: ' . $wind_scale_min);
//        $this->info('$wind_scale_max: ' . $wind_scale_max);
//        $this->info('$wind_speed_min: ' . $wind_speed_min);
//        $this->info('$wind_speed_max: ' . $wind_speed_max);

        $model = new WeatherGismeteo();
        $model->temperature_comfort = $temperature_comfort;
        $model->temperature_air = $temperature_air;
        $model->pressure = $pressure;
        $model->humidity = $humidity;
        $model->wind_speed = $wind_speed;
        $model->wind_scale = $wind_scale;
        $model->description = $description;
        $model->save(false);
    }

    public function alert($string)
    {
        $this->line($string, 'warning');
    }

    public function info($string, $verbosity = null)
    {
        $this->line($string, 'info', $verbosity);
    }

    public function line($string, $style = null, $verbosity = null)
    {
        echo $string . PHP_EOL;
    }
}