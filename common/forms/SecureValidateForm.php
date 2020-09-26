<?php

namespace common\forms;

use common\models\ModuleSecureSystem;

class SecureValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleSecureSystem $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model['active']) {
            return;
        }

        if ($model === null) {
            $this->addError('payload', 'не найден topic в сенсорах');
        }

        if ($model['trigger'] && (string)$this->payload == (string)$model['alarm_condition']) {
            // TODO записать событие в лог
            if ($model['notifying']) {
                $this->addError('payload', self::getTextNotify($model['message_warn'], $this->payload));
            }
        }
    }
}