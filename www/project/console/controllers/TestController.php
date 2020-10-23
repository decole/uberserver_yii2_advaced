<?php

namespace console\controllers;

use backend\jobs\EmailNotifyJob;
use DateTime;
use yii\console\Controller;
use Yii;

/**
 * Commands for testing functional
 */
ini_set('output_buffering','on');

class TestController extends Controller
{
    public function actionIndex() {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Тестовое сообщение с сайта uberserver.ru')
            ->setTextBody('это тестовое сообщение. для проверки отправки писем')
            ->setHtmlBody('<b>это тестовое сообщение. для проверки отправки писем</b>')
            ->send();
    }

    public function actionTime()
    {
        $date = new DateTime();
        echo $date->format('Y-m-d H:i:s.u') . PHP_EOL;
    }

    public function actionEmail()
    {
        echo 'add job to send email' . PHP_EOL;
        Yii::$app->queue->push(new EmailNotifyJob([
            'message' => 'test message from site uberserver.ru',
        ]));
    }
}