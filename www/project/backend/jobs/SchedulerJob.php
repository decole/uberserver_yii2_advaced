<?php

namespace backend\jobs;

use common\services\ScheduleService;

class SchedulerJob extends BaseJob
{
    /**
     * @var mixed
     */
    public $delay;

    public function run(): void
    {
        $service = ScheduleService::getInstance();
        $service->run();
    }

    public function getName(): string
    {
        return 'SchedulerJob';
    }
}
