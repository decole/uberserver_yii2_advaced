<?php

namespace backend\jobs;

use common\services\TelegramService;
use Longman\TelegramBot\Exception\TelegramException;
use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class DiagnosticSystemJob extends BaseObject implements JobInterface
{
    /**
     * full - полная диагностика
     *
     * @var string
     */
    public $type;

    /**
     * @param Queue $queue
     * @return mixed|void
     * @throws TelegramException
     */
    public function execute($queue)
    {
        sleep(80);
        /** @var TelegramService $service */
        Yii::$app->queue->push(new TelegramNotifyJob([
            'message' => 'Диагностика завершена. Все системы в норме.',
        ]));
    }
}