<?php

namespace common\modules\yandexSkill\dialogs;

//use common\services\MqttService;

class FireSecureDialog implements AliceInterface
{
    public function __construct()
    {
    }

    public function listVerb()
    {
        return ['пожарная', 'пожарную', 'пожарной'];
    }

    public function process($message)
    {
        // TODO make logic
//        $status = MqttService::getCacheMqtt('home/firesensor/fire_state');
        $status = 0;
        $status = ($status === '0') ? 'норма' : 'пожар';
        return 'Система пожарной безопасности в статусе - ' . $status;
    }

    public function verb($message)
    {
        // TODO: Implement verb() method.
    }
}
