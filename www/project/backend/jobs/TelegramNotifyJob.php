<?php

namespace backend\jobs;

use common\services\TelegramService;
use Longman\TelegramBot\Exception\TelegramException;

class TelegramNotifyJob extends BaseJob
{
    public $message;

    /**
     * @return void
     * @throws TelegramException
     */
    public function run()
    {
        $service = TelegramService::getInstance();
        $service->sendDecole($this->message);
    }

    public function getName()
    {
        return 'TelegramNotifyJob';
    }
}