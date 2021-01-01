<?php

namespace common\modules\yandexSkill\dialogs;

use common\modules\yandexSkill\services\DialogService;

class FireSecureDialog implements AliceInterface
{
    public function listVerb(): array
    {
        return ['пожарная', 'пожарную', 'пожарной'];
    }

    public function process($message): string
    {
        $service = new DialogService();

        return $service->statusFireSecureSystem();
    }

    public function verb($message): void
    {
    }
}
