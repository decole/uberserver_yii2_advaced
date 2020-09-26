<?php

namespace common\forms;

use common\models\ModuleLeakage;

class LeakageValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleLeakage $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model['active']) {
            return;
        }

        if ($model === null) {
            $this->addError('topic', 'не найден topic в сенсорах');
        }

        if ($model['notifying'] && ((string)$this->payload == (string)$model['check_up'])) {
            $this->addError('payload', self::getTextNotify($model['message_warn'], $this->payload));
        }

        if ($model['notifying'] && (((string)$this->payload != (string)$model['check_up']) &&
                ((string)$this->payload != (string)$model['check_down']))
        ) {
            $this->addError('payload', $model['name'] . ' неизвестный payload - ' . $this->payload .
                ' check_down: ' . $model['check_down'] . ' check_up: ' . $model['check_up']);
        }
    }
}