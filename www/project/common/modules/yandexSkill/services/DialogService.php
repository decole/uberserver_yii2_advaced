<?php

namespace common\modules\yandexSkill\services;

use common\models\ModuleFireSystem;
use common\models\ModuleSecureSystem;
use common\models\ModuleSensor;
use Yii;

class DialogService
{
    public function statusSensors(): string
    {
        $request = 'Статус сенсоров: ';
        $bugs = '';

        $sensors = ModuleSensor::find()
            ->where([
                'active' => 1,
                'type' => 1,
            ])
            ->all();

        $compileSensors = [];
        $compileBags = [];

        /** @var ModuleSensor[] $sensors */
        foreach ($sensors as $sensor) {
            $cache = Yii::$app->cache->get($sensor->topic);

            if ($cache === false) {
                $compileBags[] = $sensor->name;

                continue;
            }

            $compileSensors[] = $sensor->name . ' ' . $cache . ' градусов';

        }

        $request .= implode(', ', $compileSensors);

        if (!empty($compileBags)) {
            $bugs = '. Не отвечают следующие сенсоры: ';
            $bugs .= implode(', ', $compileBags);
        }

        return $request . $bugs;
    }

    public function statusSecureSystem(): string
    {
        $state = 0;
        $topics = ModuleSecureSystem::find()->asArray()->all();

        foreach ($topics as $topic) {
            $state += (int)Yii::$app->cache->get($topic['topic']);
        }

        $status = (int)$state === 0 ? 'в режиме ожидания' : 'взведена';

        return 'Охранная система безопасности ' . $status;
    }

    public function statusFireSecureSystem(): string
    {
        $state = 0;
        $topics = ModuleFireSystem::find()->asArray()->all();

        foreach ($topics as $topic) {
            $state += (int)Yii::$app->cache->get($topic['topic']);
        }

        $status = (int)$state === 0 ? 'норма' : 'пожар';

        return 'Система пожарной безопасности в статусе - ' . $status;
    }
}
