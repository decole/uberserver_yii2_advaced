<?php

namespace common\forms;

use common\models\ModuleRelay;

class RelayValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleRelay $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model['active']) {
            return;
        }

        if ($model === null) {
            $this->addError('topic', 'не найден topic в сенсорах');
            $this->addError('payload', 'не найден topic в сенсорах');
        }

        if ($model['notifying']) {
            // сверка проверочного топика
            if ((string)$this->topic == (string)$model['check_topic']
                && (string)$this->payload != (string)$model['check_command_on']
                && (string)$this->payload != (string)$model['check_command_off']
            ) {
                $this->addError('payload', 'реле ' . $model['name'] .
                ' имеет неизвестное проверочное состояние');
            }

            if ((string)$this->topic == (string)$model['check_topic']) {
                if ($model['command_on'] == $this->payload && $model['command_off'] == $this->payload) {
                    $this->addError('payload', 'реле ' . $model['name'] .
                    ' передана неизвестная команда');
                }
            }

            if ((string)$this->topic == (string)$model['topic']) {
                if ($model['command_on'] == $this->payload || $model['command_off'] == $this->payload) {
                    $relay = ModuleRelay::findOne($model['id']);
                    $relay->last_command = $this->payload;
                    $relay->save(false);
                }
            }
        }
    }
}
