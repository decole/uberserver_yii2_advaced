<?php

namespace console\controllers;

use backend\jobs\EmailNotifyJob;
use backend\jobs\FailJob;
use backend\jobs\TelegramNotifyJob;
use common\components\EventManager;
use common\components\ParamsEvent;
use common\events\Event;
use DateTime;
use Yii;
use yii\base\Security;
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

    public function actionTelegram()
    {
        echo 'add job to send telegram message' . PHP_EOL;
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'test message from site uberserver.ru',
        ]));
    }

    public function actionAddFailJob()
    {
        Yii::$app->queue->push(new FailJob([
            'type' => 'test message from site uberserver.ru',
        ]));
    }

    public function actionGenpas($pass = 'qwerty123')
    {
        $secure = new Security();
        echo 'password: ' . $pass . PHP_EOL;
        echo $secure->generatePasswordHash($pass) . PHP_EOL;
    }

    public function actionEvent($error = 'test')
    {
        // развернута система событий для консольных приложений. пока только тесты
        $eventManager = new EventManager();
        $events = include_once(Yii::getAlias('@common') . '/config/events.php');
        $eventManager->registerHandlers($events);

        $event = new ParamsEvent([
            'sender' => $this,
            'params' => ['error' => $error],
        ]);
        Yii::$app->trigger(Event::EVENT_SEND_ALARM_NOTIFICATION, $event);
        var_dump($event->getResult());
    }
}