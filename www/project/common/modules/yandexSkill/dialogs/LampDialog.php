<?php

namespace common\modules\yandexSkill\dialogs;

use common\services\MqttService;

class LampDialog implements AliceInterface
{
    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        $this->text = 'Команда не распознана';
    }

    public function listVerb()
    {
        return ['свет', 'лампа', 'лампу'];
    }

    public function process($message)
    {
        if (is_array($message)) {
            foreach ($message as $value) {
                self::verb($value);
            }
        }
        else {
            if(!empty($message)) {
                self::verb($message);
            }
        }

        return $this->text;
    }

    public function verb($message)
    {
        (in_array( $message, ['включить', 'включи', 'включай'] ))    ? self::turnOn() : null;
        (in_array( $message, ['выключить', 'выключи', 'выключай'] )) ? self::turnOff() : null;
    }

    private function turnOn()
    {
        (new MqttService())->post('margulis/lamp01', 'on');
        $this->text = 'Лампа включена';
    }

    private function turnOff()
    {
        (new MqttService())->post('margulis/lamp01', 'off');
        $this->text = 'Лампа выключена';
    }
}
