<?php

namespace console\controllers;

use backend\jobs\EmailNotifyJob;
use DateTime;
use Yii;
use yii\console\Controller;

/**
 * Commands for testing functional
 */
ini_set('output_buffering','on');

class TestController extends Controller
{
    public function actionIndex() {
        /*
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Тестовое сообщение с сайта uberserver.ru')
            ->setTextBody('это тестовое сообщение. для проверки отправки писем')
            ->setHtmlBody('<b>это тестовое сообщение. для проверки отправки писем</b>')
            ->send();
        */

/*
        $state = 0;
        $topics = ModuleFireSystem::find()->asArray()->all();

        foreach ($topics as $topic) {
            $state += (int)Yii::$app->cache->get($topic['topic']);
        }
*/


//        $model = MqttSecure::where('topic', $topic)->first();
//        $model->trigger = $state;
//        if ( $model->save() ) {
//            (new DeviceService)->refresh();
//            $model::logChangeTrigger($model->topic, $model->trigger);
//        }

//        $topic = 'home/security/margulis/1';
//        $model = ModuleSecureSystem::find()->where(['topic' => $topic])->limit(1)->one();
//        $model->trigger = (int)(bool)!$model->trigger;
//        $model->save();
//
//        var_dump($model->trigger);
//        exit();
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