<?php

namespace backend\jobs;

use common\services\TelegramService;
use Yii;

class DiagnosticSystemJob extends BaseJob
{
    /**
     * full - полная диагностика
     *
     * @var string
     */
    public $type;

    public function run()
    {
        sleep(80);
        /** @var TelegramService $service */
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'Диагностика завершена. Все системы в норме.',
        ]));
    }

    public function getName()
    {
        return 'DiagnosticSystemJob';
    }
}