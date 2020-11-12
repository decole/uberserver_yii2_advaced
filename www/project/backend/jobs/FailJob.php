<?php

namespace backend\jobs;

use Yii;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\queue\JobInterface;

class FailJob extends BaseObject implements JobInterface
{
    /**
     * создать родителя, который выполнение команды обернет в try, где прирм в ErrorException сохранит багу в БД
     */
    public $type;

    public function execute($queue)
    {
        sleep(10);

        try {
            10/0;
        } catch (ErrorException $e) {
            Yii::warning("Деление на ноль.");
        }

    }
}