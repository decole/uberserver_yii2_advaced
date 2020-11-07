<?php

namespace common\modules\yandexSkill\dialogs;

class PingDialog implements AliceInterface
{
    public function __construct()
    {
    }

    public function listVerb()
    {
        return ['ping'];
    }

     public function process($message)
    {
        return 'pong';
    }

     public function verb($message)
    {
    }
}
