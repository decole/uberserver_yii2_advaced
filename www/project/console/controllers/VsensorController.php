<?php

namespace console\controllers;

use common\services\MqttService;
use yii\console\Controller;

class VsensorController extends Controller
{
    public function actionIndex(): void
    {
        $service = new MqttService();
        $service->post('out_topic', 'virtual-sensor');
        sleep(1);
        $service->post('virtual/sensor/temperature', rand(0, 30));
        $service->disconnect();
    }
}
