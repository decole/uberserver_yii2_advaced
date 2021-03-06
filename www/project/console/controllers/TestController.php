<?php

namespace console\controllers;

use backend\jobs\EmailNotifyJob;
use backend\jobs\FailJob;
use backend\jobs\SchedulerJob;
use backend\jobs\TelegramNotifyJob;
use common\components\EventManager;
use common\components\ParamsEvent;
use common\events\Event;
use common\models\ModuleRelay;
use common\models\ModuleSensor;
use common\modules\yandexSkill\services\DialogService;
use DateTime;
use Yii;
use yii\base\Security;
use yii\console\Controller;

/**
 * Commands for testing functional
 */
ini_set('output_buffering', 'on');

class TestController extends Controller
{
    public function actionIndex(): void
    {
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

    public function actionTime(): void
    {
        $date = new DateTime();
        echo $date->format('Y-m-d H:i:s.u') . PHP_EOL;
    }

    public function actionEmail(): void
    {
        echo 'add job to send email' . PHP_EOL;
        Yii::$app->queue->push(new EmailNotifyJob([
            'message' => 'test message from site uberserver.ru',
        ]));
    }

    public function actionTelegram(): void
    {
        echo 'add job to send telegram message' . PHP_EOL;
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'test message from site uberserver.ru',
        ]));
    }

    public function actionAddFailJob(): void
    {
        Yii::$app->queue->push(new FailJob([
            'type' => 'test message from site uberserver.ru',
        ]));
    }

    public function actionGenpas(string $pass = 'qwerty123'): void
    {
        $secure = new Security();
        echo 'password: ' . $pass . PHP_EOL;
        echo $secure->generatePasswordHash($pass) . PHP_EOL;
    }

    public function actionEvent(string $error = 'test'): void
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

    public function actionInit(): void
    {
        Yii::$app->queue->push(new SchedulerJob());
    }

    public function actionStatus(): void
    {
        $queue = Yii::$app->db->createCommand('SELECT * FROM queue')
            ->queryAll();

        var_dump($queue);
    }

    public function actionT(): void
    {
//        $service = ScheduleService::getInstance();
//        $service->run();
        $message = 'Сенсоры работают';
        $sensorBug = [];
        $relayBug = [];

        $sensors = ModuleSensor::find()
            ->where(['active' => 1])
            ->asArray()
            ->all();

        foreach ($sensors as $sensor) {
            if (Yii::$app->cache->get($sensor['topic']) === false) {
                $sensorBug[] = $sensor['name'];
            }
        }

        if (!empty($sensorBug)) {
            $message .= ', кроме: ' . implode(', ', $sensorBug);
        }

        $relays = ModuleRelay::find()
            ->where(['active' => 1])
            ->asArray()
            ->all();

        foreach ($relays as $relay) {
            if (Yii::$app->cache->get($relay['check_topic']) === false) {
                $relayBug[] = $relay['name'];
            }
        }

        $message .= '. Реле работают';

        if (!empty($relayBug)) {
            $message .= ', кроме: ' . implode(', ', $relayBug);
        }

        $service = new DialogService();
        $message .= '. ' . $service->statusSecureSystem();
        $message .= '. ' . $service->statusFireSecureSystem();

        echo $message . PHP_EOL;
    }
}
