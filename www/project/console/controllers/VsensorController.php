<?php

namespace console\controllers;

use common\services\MqttService;
use yii\console\Controller;

class VsensorController extends Controller
{
    public function actionIndex() {
        echo 'virtual sensor is start' . PHP_EOL;
        $service = new MqttService;
        $service->post('out_topic', 'virtual-sensor');
        sleep(1);
        $service->post('virtual/sensor/temperature', rand(0, 30));
        $service->disconnect();
        echo 'virtual sensor send data to topic: virtual/sensor/temperature' . PHP_EOL;

        exit();
    }
}