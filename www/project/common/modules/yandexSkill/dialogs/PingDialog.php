<?php

namespace common\modules\yandexSkill\dialogs;

class PingDialog implements AliceInterface
{
    public function listVerb(): array
    {
        return ['ping'];
    }

    public function process($message): string
    {
        return 'pong';
    }

    public function verb($message): void
    {
    }
}
