<?php

namespace common\modules\yandexSkill\dialogs;

use common\modules\yandexSkill\services\DialogService;
use Yii;

class StatusDialog implements AliceInterface
{
    /**
     * @return string[]
     */
    public function listVerb(): array
    {
        return ['статус', 'статуса', 'статусу'];
    }

    public function process($message = null): string
    {
        $service = Yii::createObject(DialogService::class);

        $text = $service->statusSensors();
        $text .= '. ' . $service->statusSecureSystem();
        $text .= '. ' . $service->statusFireSecureSystem();

        return $text;
    }

    public function verb($message): void
    {
    }
}
