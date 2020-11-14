<?php

namespace backend\jobs;

use Yii;

class EmailNotifyJob extends BaseJob
{
    public $message;

    /**
     * @return void
     */
    public function run()
    {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Тестовое сообщение с сайта uberserver.ru')
            ->setTextBody($this->message)
            ->setHtmlBody('<b>'. $this->message . '</b>')
            ->send();
    }

    public function getName()
    {
        return 'EmailNotifyJob';
    }
}