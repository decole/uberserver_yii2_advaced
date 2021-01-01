<?php

namespace backend\jobs;

use common\modules\yandexSkill\services\DialogService;
use Yii;

class DiagnosticSystemJob extends BaseJob
{
    public function run(): void
    {
        $service = new DialogService();

        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => $service->statusFull(),
        ]));
    }

    public function getName(): string
    {
        return 'DiagnosticSystemJob';
    }
}
