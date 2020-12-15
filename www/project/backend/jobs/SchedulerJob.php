<?php

namespace backend\jobs;

use common\services\ScheduleService;
use Yii;

class SchedulerJob extends BaseJob
{
    public function run(): void
    {
        Yii::$app->queue->delay(60)->push(new SchedulerJob());

        $service = ScheduleService::getInstance();
        $service->run();
    }

    public function getName(): string
    {
        return 'SchedulerJob';
    }
}