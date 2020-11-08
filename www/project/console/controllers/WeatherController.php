<?php

namespace console\controllers;

use common\models\Weather;
use yii\console\Controller;

class WeatherController extends Controller
{
    public function actionIndex() {
        echo 'start saving weather' . PHP_EOL;
        $temp         = null;
        $weather_spec = null;

        $page    = file_get_contents( 'http://apidev.accuweather.com/currentconditions/v1/291309.json?language=ru-ru&apikey=hoArfRosT1215' );
        $decoded = json_decode( $page, true );
        if ( is_array( $decoded ) ) {
            if ( ! empty( $decoded[0]['Temperature']['Metric']['Value'] ) ) {
                $temp = $decoded[0]['Temperature']['Metric']['Value'];
            }
            $weather_spec = $decoded[0]['WeatherText'];
        }

        $model              = new Weather();
        $model->temperature = $temp;
        $model->spec        = $weather_spec;
        $model->save();
    }
}