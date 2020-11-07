<?php

namespace common\modules\yandexSkill\dialogs;

use common\models\ModuleFireSystem;
use Yii;

class FireSecureDialog implements AliceInterface
{
    public function __construct()
    {
    }

    public function listVerb()
    {
        return ['пожарная', 'пожарную', 'пожарной'];
    }

    public function process($message)
    {
        $state = 0;
        $topics = ModuleFireSystem::find()->asArray()->all();

        foreach ($topics as $topic) {
            $state += (int)Yii::$app->cache->get($topic['topic']);
        }

        $status = ((int)$state === 0) ? 'норма' : 'пожар';

        return 'Система пожарной безопасности в статусе - ' . $status;
    }

    public function verb($message)
    {
    }
}
