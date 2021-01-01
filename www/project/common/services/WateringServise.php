<?php

namespace common\services;

use common\models\ModuleLeakage;
use common\models\ModuleRelay;
use common\traits\instance;
use Longman\TelegramBot\Exception\TelegramException;
use Yii;

class WateringServise
{
    use instance;

    public function waterLeakage(): bool
    {
        $leakage = ModuleLeakage::findAll(['active' => 1]);

        foreach ($leakage as $topic) {
            if (Yii::$app->cache->get($topic)) {
                return true;
            }
        }

        return false;
    }

    public function turnOn(string $topic): void
    {
        if ($this->waterLeakage()) {
            $serviceTelegram = new TelegramService();

            try {
                $serviceTelegram->sendDecole(
                    'Зафиксирована протечка. Не могу включить клапан - ' . $topic
                );
            } catch (TelegramException $e) {
                throw $e;
            }

            return;
        }

        $this->pushCommandOn($topic);
    }

    public function turnOff(string $topic): void
    {
        if ($this->waterLeakage()) {
            $serviceTelegram = new TelegramService();

            try {
                $serviceTelegram->sendDecole(
                    'Зафиксирована протечка. Не могу включить клапан - ' . $topic
                );
            } catch (TelegramException $e) {
                throw $e;
            }

            return;
        }

        $this->pushCommandOff($topic);
    }

    private function pushCommandOn(string $topic): void
    {
        $relay = ModuleRelay::findOne(['topic' => $topic]);
        $this->sendCommand($topic, $relay->command_on);
    }

    private function pushCommandOff(string $topic): void
    {
        $relay = ModuleRelay::findOne(['topic' => $topic]);
        $this->sendCommand($topic, $relay->command_off);
    }

    private function sendCommand(string $topic, string $payload): void
    {
        $mqtt = new MqttService();
        $mqtt->post($topic, $payload);
    }
}
