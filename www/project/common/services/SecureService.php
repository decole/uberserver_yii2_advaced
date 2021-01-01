<?php

namespace common\services;

use common\models\ModuleSecureSystem;
use common\modules\yandexSkill\services\DialogService;
use common\traits\instance;
use Throwable;

final class SecureService
{
    use instance;

    private MqttService $service;

    public function __construct()
    {
        $this->service = MqttService::getInstance();
    }

    public function triggerChange(string $topic, string $payload): bool
    {
        $model = ModuleSecureSystem::findOne(['topic' => $topic]);

        if (!$model) {
            return false;
        }

        try {
            $this->service->post($topic, $payload);
            $payload == 'on' ? $trigger = true : $trigger = false;
            $model->trigger = $trigger;

            return $model->save(false);
        } catch (Throwable $e) {
            var_dump('secure service blocked');
            var_dump($e->getMessage());
            exit();
        }
    }

    public function status(): string
    {
        $service = new DialogService();

        return $service->statusSecureSystem();
    }
}
