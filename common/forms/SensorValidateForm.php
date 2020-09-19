<?php

namespace common\forms;

use common\models\ModuleSensor;

class SensorValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleSensor $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model->active) {
            return;
        }

        if ($model === null) {
            $this->addError('topic', 'не найден topic в сенсорах');
        }

        if ($model->notifying && (
                ($model->from_condition && (integer)$this->payload > (integer)$model->from_condition) ||
                ($model->to_condition   && (integer)$this->payload < (integer)$model->to_condition)
            )
        ) {
            $this->addError('payload', self::getTextNotify($model->message_warn, $this->payload));
        }
    }
}