<?php

namespace common\modules\yandexSkill\dialogs;

use common\services\MqttService;

class WateringDialog implements AliceInterface
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
        return ['шланг', 'шланга', 'вода', 'воды', 'воду'];
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
        (new MqttService())->post('water/major', '1');
        $this->text = 'Шланг включен';
    }

    private function turnOff()
    {
        (new MqttService())->post('water/major', '0');
        $this->text = 'Шланг выключен';
    }
}
