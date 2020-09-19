<?php

namespace console\controllers;

use yii\console\Controller;
use Yii;

/**
 * Commands for MQTT sensors and posting to MQTT protocol
 */
ini_set('output_buffering','on');

class TestController extends Controller
{
    public function actionIndex() {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Message subject')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}