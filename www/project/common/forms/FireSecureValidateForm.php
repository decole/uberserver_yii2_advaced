<?php

namespace common\forms;

use common\models\HistoryFireSecureData;
use common\models\ModuleFireSystem;

class FireSecureValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleFireSystem $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model['active']) {
            return;
        }

        if ($model === null) {
            $this->addError('payload', 'не найден topic в сенсорах');
        }

        if ((string)$this->payload == (string)$model['alarm_condition']) {
            $this->saveHistory();
            $this->addError('payload', self::getTextNotify($model['message_warn'], $this->payload));
        }
    }

    private function saveHistory()
    {
        $fireSecure = new HistoryFireSecureData();
        $fireSecure->topic = $this->topic;
        $fireSecure->payload = $this->payload;
        $fireSecure->save();
    }
}