<?php

namespace common\eventHandlers;

use backend\jobs\EmailNotifyJob;
use common\components\ParamsEvent;
use Yii;

class NotificationHandler
{
    public static function sendSensorNotify(ParamsEvent $event): void
    {
        $notifyError = $event->getParam('error');

        Yii::$app->queue->push(new EmailNotifyJob([
            'message' => $notifyError,
        ]));

        $event->result[] = $notifyError . ' - ok';
    }
}