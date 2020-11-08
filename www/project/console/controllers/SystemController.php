<?php

namespace console\controllers;

use backend\jobs\DiagnosticSystemJob;
use backend\jobs\TelegramNotifyJob;
use Yii;
use yii\console\Controller;

class SystemController extends Controller
{
    public function actionIndex() {
        echo 'System Controller';
        exit();
    }

    public function actionDiagnostic()
    {
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'Старт диагностики системы. По завершению диагностики - придет другое сообщение',
        ]));

        Yii::$app->queue->push(new DiagnosticSystemJob([
            'type' => 'full',
        ]));

        exit();
    }
}