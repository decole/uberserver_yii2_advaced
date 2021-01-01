<?php

namespace common\modules\yandexSkill\dialogs;

class HelloDialog implements AliceInterface
{
    public function listVerb(): array
    {
        return ['hello', 'привет'];
    }

    public function process($message): string
    {
        return 'Привет, это частный навык Умного дома';
    }

    public function verb($message): void
    {
    }
}
