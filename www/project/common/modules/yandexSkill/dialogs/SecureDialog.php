<?php

namespace common\modules\yandexSkill\dialogs;

use common\models\ModuleSecureSystem;

class SecureDialog implements AliceInterface
{
    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        $this->text = 'Команда не распознана';
    }

    public function listVerb()
    {
        return ['охрана', 'охранная', 'охранную', 'охрану', 'безопасности', 'безопасность'];
    }

    public function process($message)
    {
        if (is_array($message)) {
            foreach ($message as $value) {
                self::verb($value);
            }
        }
        else {
            if(!empty($message)) {
                self::verb($message);
            }
        }

        return $this->text;
    }

    public function verb($message)
    {
        (in_array( $message, ['включить', 'включи', 'включай'] ))    ? self::turnOn() : null;
        (in_array( $message, ['выключить', 'выключи', 'выключай'] )) ? self::turnOff() : null;
    }

    private function turnOn()
    {
        self::changeStateTrigger('home/security/margulis/1', true);
        self::changeStateTrigger('home/security/margulis/2', true);
        $this->text = 'Система безопасности включена';
    }

    private function turnOff()
    {
        self::changeStateTrigger('home/security/margulis/1', false);
        self::changeStateTrigger('home/security/margulis/2', false);
        $this->text = 'Система безопасности выключена';
    }

    private function changeStateTrigger($topic, bool $state)
    {
        $model = ModuleSecureSystem::find()->where(['topic' => $topic])->limit(1)->one();
        $model->trigger = (int)$state;
        $model->save();
    }
}
