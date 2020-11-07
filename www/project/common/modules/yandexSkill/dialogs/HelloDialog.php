<?php

namespace common\modules\yandexSkill\dialogs;

class HelloDialog implements AliceInterface
{
    public function __construct()
    {
    }

    public function listVerb()
    {
        return ['hello', 'привет'];
    }

    public function process($message)
    {
        return 'Привет, это частный навык Умного дома';
    }

    public function verb($message)
    {
        // TODO: Implement verb() method.
    }
}
