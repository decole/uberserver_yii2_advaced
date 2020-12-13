<?php

namespace console\controllers;

use common\services\MqttService;
use yii\console\Controller;

/**
 * Commands for MQTT sensors and posting to MQTT protocol
 */
ini_set('output_buffering', 'on');

class MqttController extends Controller
{
    public function actionStart(): void 
    {
        $service = MqttService::getInstance();
        $service->listen();
    }
}
