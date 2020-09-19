<?php

namespace common\forms;

use common\models\ModuleRelay;

class RelayValidateForm extends BaseValidateForm
{
    public function payloadValidator(): void
    {
        /** @var ModuleRelay $model */
        $model = $this->processor->getSensorModel($this->topic);

        if (!$model->active) {
            return;
        }

        if ($model === null) {
            $this->addError('topic', 'не найден topic в сенсорах');
            $this->addError('payload', 'не найден topic в сенсорах'); // TODO посмотреть это
        }

        // TODO сделать проверки:
        //     - проверочные топики (ответ сравнить с значениями состояний)
        //     - топики (сравнить команду с командами состояний)

//                if (
//                    ((string)$message->payload != (string)$value['check_command_on']) &&
//                    ((string)$message->payload != (string)$value['check_command_off'])
//                ) {
//
//                }

//            if ($value['topic'] == $message->topic) {
//                if (DeviceService::is_active($value) == false) {
//                    MqttRelay::logChangeState($message->topic, 'на деактивированный топик пришла комманда');
//                    $notify = 'на деактивированный топик ' . $message->topic . ' пришла комманда {value}';
//                    DeviceService::SendNotify(new RelayNotify($notify, $message));
//                    break;
//                }
//                $payload = $message->payload;
//                if ($value['command_on'] == $payload || $value['command_off'] == $payload) {
//                    /** @var MqttRelay $relay */
//                    $relay = MqttRelay::where('topic', $message->topic)->first();
//                    $relay->last_command = $payload;
//                    $relay->save();
//                    if ($relay->type == 8) {
//                        if ( $value['command_on'] == $payload ) {
//                            MqttRelay::logChangeState($message->topic, 'включен - прямая команда');
//                        }
//                        if ( $value['command_off'] == $payload ) {
//                            MqttRelay::logChangeState($message->topic, 'выключен - прямая команда');
//                        }
//                    }
//                }
//                break;
//            }
//        }


//        if ($model->notifying && (
//                ($model->from_condition && (integer)$this->payload > (integer)$model->from_condition) ||
//                ($model->to_condition   && (integer)$this->payload < (integer)$model->to_condition)
//            )
//        ) {
//            $this->addError('payload', self::getTextNotify($model->message_warn, $this->payload));
//        }
    }
}