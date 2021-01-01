<?php

namespace common\modules\yandexSkill\dialogs;

use common\services\WateringServise;

class WateringDialog implements AliceInterface
{
    public string $text;

    private WateringServise $service;

    public function __construct()
    {
        $this->service = new WateringServise();
        $this->text = 'Команда не распознана';
    }

    public function listVerb(): array
    {
        return ['шланг', 'шланга', 'вода', 'воды', 'воду'];
    }

    public function process($message): string
    {
        if (is_array($message)) {
            foreach ($message as $value) {
                $this->verb($value);
            }
        } else {
            if (!empty($message)) {
                $this->verb($message);
            }
        }

        return $this->text;
    }

    public function verb($message): void
    {
        in_array($message, ['включить', 'включи', 'включай']) ? $this->turnOn() : null;
        in_array($message, ['выключить', 'выключи', 'выключай']) ? $this->turnOff() : null;
    }

    private function turnOn(): void
    {
        $topic = $this->service->topicMajor;
        $this->service->turnOn($topic);
        $this->text = 'Шланг включен';
    }

    private function turnOff(): void
    {
        $topic = $this->service->topicMajor;
        $this->service->turnOff($topic);
        $this->text = 'Шланг выключен';
    }
}
