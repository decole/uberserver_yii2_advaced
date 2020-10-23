<?php

namespace backend\jobs;

use common\services\TelegramService;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class TelegramNotifyJob extends BaseObject implements JobInterface
{
    public $message;

    /**
     * @param \yii\queue\Queue $queue
     * @return mixed|void
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute($queue)
    {
        /** @var TelegramService $service */
        $service = TelegramService::getInstance();
        $service->sendDecole($this->message);
    }
}