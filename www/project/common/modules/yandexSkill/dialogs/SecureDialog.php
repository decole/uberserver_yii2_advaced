<?php

namespace common\modules\yandexSkill\dialogs;

use common\modules\yandexSkill\services\DialogService;
use common\services\SecureService;

class SecureDialog implements AliceInterface
{
    public string $text;

    public function __construct()
    {
        $this->text = 'Команда не распознана';
    }

    public function listVerb(): array
    {
        return ['охрана', 'охранная', 'охранную', 'охрану', 'безопасности', 'безопасность'];
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
        in_array($message, ['статус', 'состояние']) ? $this->status() : null;
    }

    private function turnOn(): void
    {
        $this->changeStateTrigger('home/security/margulis/1', true);
        $this->changeStateTrigger('home/security/margulis/2', true);
        $this->text = 'Система безопасности включена';
    }

    private function turnOff(): void
    {
        $this->changeStateTrigger('home/security/margulis/1', false);
        $this->changeStateTrigger('home/security/margulis/2', false);
        $this->text = 'Система безопасности выключена';
    }

    private function changeStateTrigger(string $topic, bool $state): void
    {
        $service = SecureService::getInstance();
        $payload = (bool)$state ? 'on' : 'off';
        $service->triggerChange($topic, $payload);
    }

    public function status(): void
    {
        $service = new DialogService();

        $this->text = $service->statusSecureSystem();
    }
}
