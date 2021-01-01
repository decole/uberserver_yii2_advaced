<?php

namespace common\modules\yandexSkill\dialogs;

use backend\jobs\DiagnosticSystemJob;
use Yii;

class DiagnosticDialog implements AliceInterface
{
    public function listVerb(): array
    {
        return ['диагностика', 'диагностики', 'диагностику'];
    }

    public function process($message): string
    {
        Yii::$app->queue->push(new DiagnosticSystemJob());

        return 'Самодиагностика запланирована в менеджере задач. Конечные данные придут в телеграм чат.';
    }

    public function verb($message): void
    {
    }
}
