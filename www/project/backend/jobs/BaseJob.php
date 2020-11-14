<?php

namespace backend\jobs;

use common\models\Notification;
use Yii;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\queue\JobInterface;

abstract class BaseJob extends BaseObject implements JobInterface
{
    public function execute($queue)
    {
        try {
            $this->run();
        } catch (ErrorException $e) {
            $message = date('[d.M.Y H:i:s] ') . $this->getName() . ' - ошибка выполнения задачи. Более подробно смотри в логах. ' .
                $e->getMessage();
            $model = new Notification();
            $model->type = 'job-error';
            $model->data =substr($message, 0, Notification::FIELD_DATA_LIMIT);
            $model->read_at = null;
            $model->save();

            Yii::error($e->getMessage());
        }
    }

    abstract function run();

    abstract function getName();
}