<?php

namespace backend\jobs;

use Longman\TelegramBot\Exception\TelegramException;
use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class EmailNotifyJob extends BaseObject implements JobInterface
{
    public $message;

    /**
     * @param Queue $queue
     * @return mixed|void
     * @throws TelegramException
     */
    public function execute($queue)
    {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Тестовое сообщение с сайта uberserver.ru')
            ->setTextBody($this->message)
            ->setHtmlBody('<b>'. $this->message . '</b>')
            ->send();
    }
}